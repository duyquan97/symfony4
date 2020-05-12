<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use http\Client\Curl\User;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/product")
 *
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository,Request $request, PaginatorInterface $paginator, CategoryRepository $categoryRepository): Response
    {
//        dd($this->getUser());
        $input = $request->query->all();
        $name = !empty($input['name']) ? $input['name'] : '';
        $category = !empty($input['category_id']) ? $categoryRepository->find($input['category_id']) : '';
        $price_min= !empty($input['price_min']) ? $input['price_min'] : '';
        $price_max = !empty($input['price_max']) ? $input['price_max'] : '';
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->list();
        $data = $productRepository->filterData($name,$category,$price_min,$price_max);
//        $data = $productRepository->findAll();
        $products = $paginator->paginate($data, $request->query->getInt('page', 1), 5);
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'input' => $input
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */

    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        $data = $form->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form['image']->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
                if(in_array($originalFilename, $allowed_extensions)){
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                    $product->setImage($newFilename);
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
            $product->setCode($code);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     * @IsGranted("POST_VIEW", subject="product")
     */
    public function show(Product $product): Response
    {

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     * @IsGranted("POST_EDIT", subject="product")
     *
     */
    public function edit(Request $request, Product $product,ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form['image']->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
                if (in_array($originalFilename, $allowed_extensions)) {
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                    $product->setImage($newFilename);
                    try {
                        $image->move(
                            $this->getParameter('brochures_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                    }
                }
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
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
