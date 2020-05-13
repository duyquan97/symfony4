<?php

namespace App\Controller;

use App\Entity\ListHoliday;
use App\Form\ListHolidayType;
use App\Repository\ListHolidayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/list/holiday")
 */
class ListHolidayController extends AbstractController
{
    /**
     * @Route("/", name="list_holiday_index", methods={"GET"})
     */
    public function index(ListHolidayRepository $listHolidayRepository): Response
    {
        return $this->render('list_holiday/index.html.twig', [
            'list_holidays' => $listHolidayRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="list_holiday_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $listHoliday = new ListHoliday();
        $form = $this->createForm(ListHolidayType::class, $listHoliday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($listHoliday);
            $entityManager->flush();

            return $this->redirectToRoute('list_holiday_index');
        }

        return $this->render('list_holiday/new.html.twig', [
            'list_holiday' => $listHoliday,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="list_holiday_show", methods={"GET"})
     */
    public function show(ListHoliday $listHoliday): Response
    {
        return $this->render('list_holiday/show.html.twig', [
            'list_holiday' => $listHoliday,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="list_holiday_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ListHoliday $listHoliday): Response
    {
        $form = $this->createForm(ListHolidayType::class, $listHoliday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list_holiday_index');
        }

        return $this->render('list_holiday/edit.html.twig', [
            'list_holiday' => $listHoliday,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="list_holiday_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ListHoliday $listHoliday): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listHoliday->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($listHoliday);
            $entityManager->flush();
        }

        return $this->redirectToRoute('list_holiday_index');
    }
}
