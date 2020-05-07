<?php

namespace App\Controller;



use App\Repository\ProductRepository;
use App\Service\MarkdownHelper;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Cookie;

class TestController extends AbstractController
{

    /**
     * @Route("/admin", name="admin_home")
     * @IsGranted("ROLE_ADMIN")
     */
    public function admin(ProductRepository $repository, Request $request, PaginatorInterface $paginator){

    }
    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug, AdapterInterface $cache,MarkdownParserInterface $markdown,MarkdownHelper $helper)
    {
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];
        $articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
turkey shank eu pork belly meatball non cupim.
Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.
Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.
EOF;

        $item = $helper->parse($articleContent);
        dd($item);
        $item = $cache->getItem('markdown_'.md5($articleContent));
        if (!$item->isHit()) {
            $item->set($articleContent);
            $cache->save($item);
        }
        $articleContent = $item->get();
        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'comments' => $comments,
            'articleContent' => $articleContent,
        ]);
    }
    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        // TODO - actually heart/unheart the article!
        $logger->info('Article is being hearted!');
        return new JsonResponse(['hearts' => rand(5, 100)]);
    }

    /**
     * @Route("/session", name="session", methods={"GET"})
     */
    public function testSession(Request $request)
    {
        $session = new Session();
        $session->start();
        $session->set('oke', 'Drak');


    }
    /**
     * @Route("/student/ajax", name="ajax_student", methods={"POST"})
     */
    public function ajaxAction(Request $request) {


        $array = array(
            [
                'name'=> 'Duy Quan',
                'address' => 'Bac Giang'
            ],
            [
                'name'=> 'A Giang',
                'address' => 'Yen Bai'
            ],
        );
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach($array as $student) {
                $temp = array(
                    'name' => $student['name'],
                    'address' => $student['address']
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            $jsonData = [];
            return new JsonResponse($jsonData);
        }
    }

}
//
//
//namespace App\Controller;
//
//use App\Entity\Product;
//use App\Entity\Category;
//use App\Form\ProductType;
//use App\Repository\ProductRepository;
//use App\Repository\CategoryRepository;
//use App\Service\MarkdownHelper;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\HttpFoundation\File\Exception\FileException;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Knp\Component\Pager\PaginatorInterface;
//use Symfony\Component\Validator\Validator\ValidatorInterface;
//use Symfony\Component\Cache\Adapter\AdapterInterface;
//use Doctrine\ORM\EntityManagerInterface;
//
//
///**
// * @Route("/product")
// */
//class Product2Controller extends AbstractController
//{
//    /**
//     * @Route("/test", name="product_test", methods={"GET"})
//     */
//    public function test()
//    {
//        $repository = $this->getDoctrine()->getRepository(Product::class);
//        $product = $repository->findOneBy([
//            'name' => 'Bim bim']);
//        return $this->render('frontend/pages/index.html.twig', [
//        ]);
//    }
//
//    /**
//     * @Route("/", name="product_index", methods={"GET"})
//     */
//    public function index(Request $request, ProductRepository $productRepository, PaginatorInterface $paginator, AdapterInterface $cache): Response
//    {
//        $input = $request->query->all();
//
//        $categories = $this->getDoctrine()
//            ->getRepository(Category::class)
//            ->list();
//        $data = $this->getDoctrine()
//            ->getRepository(Product::class)
//            ->filterData($input);
//        $products = $paginator->paginate($data, $request->query->getInt('page', 1), 5);
//
//
//        return $this->render('product/index.html.twig', [
//            'products' => $products,
//            'categories' => $categories,
//            'input' => $input,
//        ]);
//    }
//
//    /**
//     * @Route("/new", name="product_new", methods={"GET","POST"})
//     */
//    public function new(Request $request): Response
//    {
//        $categories = $this->getDoctrine()
//            ->getRepository(Category::class)
//            ->list();
//        return $this->render('product/new.html.twig', [
//            'categories' => $categories
//        ]);
//    }
//
//    /**
//     * @Route("/store", name="product_store", methods={"GET","POST"})
//     */
//    public function store(Request $request): Response
//    {
//        $data = $request->request->all();
//        $entityManager = $this->getDoctrine()->getManager();
//        $product = new Product();
//        $product->setName($data['name']);
//        $product->setSlug(str_replace(' ', '-', $data['name']));
//        $product->setPrice($data['price']);
//        $product->setCategoryId($data['category_id']);
//
//        $image = $request->files->get('image');
//        $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
//        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
//        if ($image && in_array($extension, $allowed_extensions)) {
//            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
//            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
//            $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
//            $product->setImage($newFilename);
//            try {
//                $image->move(
//                    $this->getParameter('brochures_directory'),
//                    $newFilename
//                );
//            } catch (FileException $e) {
//            }
//
//        }
//
//        $entityManager->persist($product);
//        $entityManager->flush();
//
//        return $this->redirectToRoute('product_index');
//    }
//
//    /**
//     * @Route("/{id}", name="product_show", methods={"GET"})
//     */
//    public function show(Product $product, $id): Response
//    {
//
//        $product = $this->getDoctrine()
//            ->getRepository(Product::class)
//            ->show($id);
//
//        return $this->render('product/show.html.twig', [
//            'product' => $product[0],
//        ]);
//    }
//
//    /**
//     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, $id): Response
//    {
//        $categories = $this->getDoctrine()
//            ->getRepository(Category::class)
//            ->list();
//
//        $repository = $this->getDoctrine()->getManager()->getRepository(Product::class);
//        $product = $repository->find($id);
//        return $this->render('product/edit.html.twig', [
//            'product' => $product,
//            'categories' => $categories,
//        ]);
//    }
//
//    /**
//     * @Route("/{id}/update", name="product_update", methods={"GET","POST"})
//     */
//    public function update(Request $request, $id): Response
//    {
//        $data = $request->request->all();
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $product = $entityManager->getRepository(Product::class)->find($id);
//        $product->setName($data['name']);
//        $product->setSlug(str_replace(' ', '-', $data['name']));
//        $product->setPrice($data['price']);
//        $product->setCategoryId($data['category_id']);
//        $image = $request->files->get('image');
//        $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
//        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
//        if ($image && in_array($extension, $allowed_extensions)) {
//
//            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
//            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
//            $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
//            $product->setImage($newFilename);
//            try {
//                $image->move(
//                    $this->getParameter('brochures_directory'),
//                    $newFilename
//                );
//            } catch (FileException $e) {
//            }
//        }
//        $entityManager->flush();
//
//        return $this->redirectToRoute('product_index');
//    }
//
//    /**
//     * @Route("/{id}", name="product_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, Product $product): Response
//    {
//        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($product);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('product_index');
//    }
//
//}
//
