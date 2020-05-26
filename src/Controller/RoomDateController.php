<?php

namespace App\Controller;

use App\Entity\RoomDate;
use App\Form\RoomDateType;
use App\Repository\RoomDateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/room/date")
 */
class RoomDateController extends AbstractController
{
    /**
     * @Route("/", name="room_date_index", methods={"GET"})
     */
    public function index(RoomDateRepository $roomDateRepository): Response
    {
        return $this->render('room_date/index.html.twig', [
            'room_dates' => $roomDateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="room_date_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $roomDate = new RoomDate();
        $form = $this->createForm(RoomDateType::class, $roomDate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($roomDate);
            $entityManager->flush();

            return $this->redirectToRoute('room_date_index');
        }

        return $this->render('room_date/new.html.twig', [
            'room_date' => $roomDate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_date_show", methods={"GET"})
     */
    public function show(RoomDate $roomDate): Response
    {
        return $this->render('room_date/show.html.twig', [
            'room_date' => $roomDate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="room_date_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RoomDate $roomDate): Response
    {
        $form = $this->createForm(RoomDateType::class, $roomDate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('room_date_index');
        }

        return $this->render('room_date/edit.html.twig', [
            'room_date' => $roomDate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_date_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RoomDate $roomDate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$roomDate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($roomDate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('room_date_index');
    }
}
