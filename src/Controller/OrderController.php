<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use App\Repository\RoomsRepository;
use App\Service\BookingHelper;
use Carbon\Carbon;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order")
 *
 */
class OrderController extends AbstractController
{
    /**
     * @Route("/", name="order_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $user = $this->getUser();
        !empty($user) && count($user->getRoles()) == 1 ? $user : $user = '';

        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->index($user),
        ]);
    }

    /**
     * @Route("/new", name="order_new", methods={"GET","POST"})
     * @IsGranted("BOOKING")
     */
    public function new(Request $request, RoomsRepository $roomsRepository, BookingHelper $bookingHelper): Response
    {
        $user = $this->getUser();
        $session = new Session();
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
         !empty($session->get('order')) ? $data = $session->get('order') : $data = '';
        $data != '' ? $room = $roomsRepository->find($data['room']) : $room = '';
        if ($form->isSubmitted() && $form->isValid()) {
            $formDate = Carbon::parse($form->get('fromDate')->getData())->toDateString();
            $toDate = Carbon::parse($form->get('toDate')->getData())->toDateString();
            $checkOut = $bookingHelper->checkOut($data['room'],$formDate,$toDate);
            if (!is_array($checkOut)){
                $this->addFlash('error', $checkOut);
                return $this->redirectToRoute('order_new');
            }
            elseif (!$user) {
                $this->addFlash('error', 'You need to log in to booking!');
                return $this->redirectToRoute('order_new');
            }
            elseif ($user) {
                $order->setUser($user);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($order);
                $entityManager->flush();
                $this->addFlash('success', 'You have successfully booked a room.');
                $session->remove('order');
                return $this->redirectToRoute('order_index');
            }
        }

        return $this->render('order/new.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
            'data' => $data,
            'room' => $room
        ]);
    }

    /**
     * @Route("/{id}", name="order_show", methods={"GET"})
     * @IsGranted("SHOW", subject="order")
     */
    public function show(Order $order): Response
    {
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="order_edit", methods={"GET","POST"})
     * @IsGranted("ACCEPT", subject="order")
     */
    public function edit(Request $request, Order $order): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_delete", methods={"DELETE"})
     * @IsGranted("ACCEPT", subject="order")
     */
    public function delete(Request $request, Order $order): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_index');
    }

    /**
     * @Route("/ajax/booking", name="ajax_newOrder",methods={"POST"})
     *
     */
    public function ajaxPrice(Request $request, BookingHelper $bookingHelper)
    {
        $session = new Session();
        $room = $session->get('order')['room'];
        $input = $request->request->all();
        $data = $bookingHelper->checkOut($room, $input['from_date'], $input['to_date']);
        if (is_array($data)){
            return new JsonResponse($data);
        }
        return new JsonResponse($data);
    }
}
