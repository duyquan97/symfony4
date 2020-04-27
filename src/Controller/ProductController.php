<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->index();
        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->list();
        return $this->render('product/new.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/store", name="product_store", methods={"GET","POST"})
     */
    public function store(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->query->all();
        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $product->setCategoryId($data['category_id']);

        $entityManager->persist($product);
        $entityManager->flush();
        return  $this->redirectToRoute('product_index');
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product, $id): Response
    {

        $product =  $this->getDoctrine()
            ->getRepository(Product::class)
            ->show($id);

        return $this->render('product/show.html.twig', [
            'product' => $product[0],
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, $id): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->list();

        $repository = $this->getDoctrine()->getManager()->getRepository(Product::class);
        $product = $repository->find($id);
        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/{id}/update", name="product_update", methods={"GET","POST"})
     */
    public function update(Request $request, $id): Response
    {
        $data = $request->query->all();
        $entityManager = $this->getDoctrine()->getManager();

        $product = $entityManager->getRepository(Product::class)->find($id);

        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $product->setCategoryId($data['category_id']);
        $entityManager->flush();

        return  $this->redirectToRoute('product_index');
    }


    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }
}
