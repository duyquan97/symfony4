<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Form\RoomsType;
use App\Repository\RoomsRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Cocur\Slugify\Slugify;

/**
 * @Route("/rooms")
 * @IsGranted("ROLE_ADMIN")
 */
class RoomsController extends AbstractController
{
    /**
     * @Route("/", name="rooms_index", methods={"GET"})
     *
     */
    public function index(RoomsRepository $roomsRepository): Response
    {
        return $this->render('rooms/index.html.twig', [
            'rooms' => $roomsRepository->findAll(),
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
     * @Route("/{id}", name="rooms_show", methods={"GET"})
     * @IsGranted("EDIT_VIEW", subject="room")
     */
    public function show(Rooms $room): Response
    {
        $description = html_entity_decode($room->getDescription());
        return $this->render('rooms/show.html.twig', [
            'room' => $room,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rooms_edit", methods={"GET","POST"})
     * @IsGranted("EDIT_VIEW", subject="room")
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
