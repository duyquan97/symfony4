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
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Doctrine\ORM\EntityManagerInterface;



/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{


    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(Request $request, ProductRepository $productRepository, PaginatorInterface $paginator,AdapterInterface $cache): Response
    {
        $input = $request->query->all();

        $categories =  $this->getDoctrine()
                            ->getRepository(Category::class)
                            ->list();
        $data   =      $this->getDoctrine()
                            ->getRepository(Product::class)
                            ->filterData($input);
        $products =   $paginator->paginate($data, $request->query->getInt('page',1),5);


        return $this->render('product/index.html.twig', [
                                   'products' => $products,
                                   'categories' => $categories,
                                   'input' => $input,
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categories =  $this->getDoctrine()
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

        $data  = $request->request->all();
        $entityManager = $this->getDoctrine()->getManager();

        $product       = new Product();
        $product->setName($data['name']);
        $product->setSlug(str_replace(' ','-',$data['name']));
        $product->setPrice($data['price']);
        $product->setCategoryId($data['category_id']);

        $image = $request->files->get('image');
        $extension = pathinfo($image->getClientOriginalName(),PATHINFO_EXTENSION);
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");
        if ( $image && in_array($extension,$allowed_extensions)) {
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
            $product->setImage($newFilename);
            try {
                $image->move(
                    $this->getParameter('brochures_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

        }

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
        $data  = $request->request->all();
        $entityManager = $this->getDoctrine()->getManager();

        $product = $entityManager->getRepository(Product::class)->find($id);
        $product->setName($data['name']);
        $product->setSlug(str_replace(' ','-',$data['name']));
        $product->setPrice($data['price']);
        $product->setCategoryId($data['category_id']);

        $image = $request->files->get('image');
        $extension = pathinfo($image->getClientOriginalName(),PATHINFO_EXTENSION);
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");
        if ( $image && in_array($extension,$allowed_extensions)) {

            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
            $product->setImage($newFilename);
            try {
                $image->move(
                    $this->getParameter('brochures_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
            }
        }
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
