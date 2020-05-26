<?php

namespace App\Controller;

use App\Entity\Room2;
use App\Form\Room2Type;
use App\Repository\Room2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/room2")
 */
class Room2Controller extends AbstractController
{
    /**
     * @Route("/", name="room2_index", methods={"GET"})
     */
    public function index(Room2Repository $room2Repository): Response
    {
        return $this->render('room2/index.html.twig', [
            'room2s' => $room2Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="room2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $room2 = new Room2();
        $form = $this->createForm(Room2Type::class, $room2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room2);
            $entityManager->flush();

            return $this->redirectToRoute('room2_index');
        }

        return $this->render('room2/new.html.twig', [
            'room2' => $room2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room2_show", methods={"GET"})
     */
    public function show(Room2 $room2): Response
    {
        return $this->render('room2/show.html.twig', [
            'room2' => $room2,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="room2_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Room2 $room2): Response
    {
        $form = $this->createForm(Room2Type::class, $room2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('room2_index');
        }

        return $this->render('room2/edit.html.twig', [
            'room2' => $room2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room2_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Room2 $room2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($room2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('room2_index');
    }
}
