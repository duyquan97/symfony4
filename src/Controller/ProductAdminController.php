<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductAdminController extends AbstractController
{

    /**
     * @Route("/admin/product", name="product_admin")
     */
    public function index()
    {
        return $this->render('product_admin/index.html.twig', [
            'controller_name' => 'ProductAdminController',
        ]);
    }
}
