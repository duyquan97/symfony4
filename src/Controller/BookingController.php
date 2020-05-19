<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\BookingType;
use App\Form\OrderType;
use App\Form\SearchType;
use App\Repository\OrderRepository;
use App\Repository\RoomsRepository;
use App\Repository\UserRepository;
use App\Service\BookingHelper;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking", name="booking_index")
     */
    public function search(Request $request, RoomsRepository $roomsRepository,PaginatorInterface $paginator)
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
        return $this->render('booking/index.html.twig', [
            'rooms'    => $rooms,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/booking/{slug}", name="booking_detail")
     *
     */
    public function show(string $slug, RoomsRepository $roomsRepository,OrderRepository $orderRepository, BookingHelper $bookingHelper, Request $request)
    {
        $user = $this->getUser();
        $room = $roomsRepository->findOneBySlug($slug);
        $session = new Session();
        $order = new Order();
        $form = $this->createForm(BookingType::class, $order);
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
            elseif (is_array($data)) {
                $order->setCode(strtoupper(uniqid()));
                $order->setPrice($data['sumPrice']);
                $order->setCurrency('VND');
                $order->setDays($data['days']);
                $order->setStatus('On');
                $order->setAccept('Off');
                $order->setRoom($room);
                $order->setUser($user);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($order);
                $entityManager->flush();

                $this->addFlash('success', 'You have successfully booked a room.');
                $this->addFlash('error', '');
            }

            return $this->redirectToRoute('booking_new', [
                'slug' => $room->getSlug(),
            ]);
        }

        return $this->render('booking/room_detail.html.twig', [
            'form' => $form->createView(),
            'room' => $room,
            'lists' => $listBooking,
            'data' => '',
        ]);
    }

    /**
     * @Route("/booking/new", name="booking_new")
     *
     */
    public function new(Request $request){
        $order = new Order();
        $form = $this->createForm(BookingType::class, $order);
        $form->handleRequest($request);
        dd(123);
    }

    /**
     * @Route("/ajax/booking", name="ajax_booking",methods={"POST"})
     *
     */
    public function ajaxPrice(Request $request, BookingHelper $bookingHelper)
    {
        $input = $request->request->all();
        $data = $bookingHelper->checkOut($input['id'], $input['from_date'], $input['to_date']);
        $html = '';
        if (is_array($data)){
            $html .= '<h5 id="days">Days: '.$data['days'].'</h5>';
            $html .= '<h5 id="price-total">Price: '.number_format($data['sumPrice']).'VND</h5>';
            return new Response($html);
        }
        $html .= '<div class="alert alert-danger">'.$data.'</div>';
        return new Response($html);

    }

}
