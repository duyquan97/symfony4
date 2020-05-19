<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Rooms;
use App\Form\BookingType;
use App\Form\ChooseDateType;
use App\Form\RoomsType;
use App\Form\SearchType;
use App\Repository\OrderRepository;
use App\Repository\RoomsRepository;
use App\Repository\UserRepository;
use App\Service\BookingHelper;
use Carbon\Carbon;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Cocur\Slugify\Slugify;
use function GuzzleHttp\Promise\all;

/**
 * @Route("/rooms")
 *
 */
class RoomsController extends AbstractController
{
    /**
     * @Route("/", name="rooms_index")
     *
     */
    public function index(RoomsRepository $roomsRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        $keyWord  = $form->get('keyWord')->getData();
        $fromDate = $form->get('fromDate')->getData();
        $toDate   = $form->get('toDate')->getData();
        $type     = $form->get('type')->getData();
        $session = new Session();

        !empty($fromDate) ? $session->set('from_date',$fromDate) : '';
        !empty($toDate) ? $session->set('to_date',$toDate) : '';
        $rooms = $paginator->paginate($roomsRepository->search( $keyWord,$fromDate,$toDate,$type), $request->query->getInt('page', 1), 6);
        return $this->render('rooms/index.html.twig', [
            'rooms' => $rooms,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="rooms_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        $room = new Rooms();
        $form = $this->createForm(RoomsType::class, $room);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $user) {
            $slugify = new Slugify();
            $image = $form['image']->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
                if(in_array($originalFilename, $allowed_extensions)){
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                    $room->setImage($newFilename);
                    try {
                        $image->move(
                            $this->getParameter('brochures_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                    }
                }
            }
            $code = strtoupper(uniqid());
            $room->setCode($code);
            $room->setSlug($slugify->slugify($form['name']->getData()));
            $room->getUser($userRepository->find($user));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('rooms_index');
        }

        return $this->render('rooms/new.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rooms_show")
     *
     */
    public function show(Rooms $room, Request $request, OrderRepository $orderRepository, BookingHelper $bookingHelper): Response
    {

        $user = $this->getUser();
        $session = new Session();
        $order = new Order();
        $form = $this->createForm(ChooseDateType::class);
        $input = $form->handleRequest($request);
        $now = date_create(date('Y-m-d',strtotime("now")));
        $listBooking = $orderRepository->listBooking($now,$room);

        if ($form->isSubmitted() && $form->isValid()) {
            $from_date = Carbon::parse($input['fromDate']->getData())->toDateString();
            $to_date = Carbon::parse($input['toDate']->getData())->toDateString();
            $data = $bookingHelper->checkOut($room->getId(), $from_date, $to_date);
            if (empty($user)){
                $this->addFlash('success', '');
                $this->addFlash('error', 'You need to log in to booking!');
            }
            elseif (!is_array($data)){
                $this->addFlash('success', '');
                $this->addFlash('error', $data);
            }
            elseif (is_array($data)){
                $data = $bookingHelper->checkOut($room->getId(), $from_date, $to_date);
                $order = [
                    'room' => $room->getId(),
                    'days' => $data['days'],
                    'sumPrice' => $data['sumPrice'],
                    'fromDate' => $form->get("fromDate")->getData(),
                    'toDate' => $form->get("toDate")->getData(),
                ];
                $session->set('order', $order);
                return $this->redirectToRoute('order_new');
            }
            return $this->redirectToRoute('rooms_show',[
                'id' => $room->getId()
            ]);
        }
        return $this->render('rooms/show.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
            'lists' => $listBooking,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rooms_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Rooms $room , UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(RoomsType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $user) {
            $image = $form['image']->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $allowed_extensions = array("jpg", "jpeg", ".png", "gif");
                if(in_array($originalFilename, $allowed_extensions)){
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                    $room->setImage($newFilename);
                    try {
                        $image->move(
                            $this->getParameter('brochures_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                    }
                }
            }
            $slugify = new Slugify();
            $slug = $slugify->slugify($form['name']->getData());
            $room->setSlug($slug);
            $room->setUser($userRepository->find($user->getId()));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rooms_index');
        }

        return $this->render('rooms/edit.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rooms_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Rooms $room): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($room);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rooms_index');
    }
}
