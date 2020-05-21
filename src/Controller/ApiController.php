<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Form\RoomsType;
use App\Repository\RoomsRepository;
use App\Repository\UserRepository;
use App\Service\CategoryService;
use Doctrine\ORM\Query;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;


class ApiController extends FOSRestController
{
    private $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService ){
        $this->categoryService = $categoryService;
    }

    /**
     * @Rest\Get("api/category")
     */
    public function index(Request $request) : View
    {
        $name = $request->query->get('name');
        if (empty($name)) {
            $name = '';
        }
        return View::create($this->categoryService->getAllCategory($name), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("api/category/{id}")
     */
    public function show(int $id) :View
    {
        return View::create($this->categoryService->getCategory($id),Response::HTTP_OK);
    }

    /**
     * @Rest\Post("api/category/new")
     */
    public function new( Request $request) :View
    {
        $name = $request->request->get('name');
        $description = $request->request->get('description');
        if (\strlen($name) < 5) {
            throw new \InvalidArgumentException('Name needs to have more then 5 characters.');
        }
        return View::create($this->categoryService->addCategory($name,$description),Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("api/category/{id}/edit")
     */
    public function edit(int $id, Request $request) :View
    {
        $name = $request->request->get('name');
        $description = $request->request->get('description');
        if (\strlen($name) < 5) {
            throw new \InvalidArgumentException('Name needs to have more then 5 characters.');
        }
        return View::create($this->categoryService->updateCategory($id, $name, $description),Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("api/category/{id}")
     */
    public function delete(int $id) :View
    {
        return View::create($this->categoryService->deleteCategory($id),Response::HTTP_OK);
    }
}
