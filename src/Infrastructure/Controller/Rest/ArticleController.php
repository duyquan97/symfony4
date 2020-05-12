<?php

namespace App\Infrastructure\Controller\Rest;



use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ArticleController extends AbstractController
{
    /**
     * Creates an Article resource
     * @Rest\Post("/product")
     * @param Request $request
     * @return View
     */
    public function postArticle(Request $request, ProductRepository $productRepository, UserRepository $userRepository, CategoryRepository $categoryRepository): View
    {
        $data = $request->query->all();
        $email = $data['email'] ? $data['email'] : '';
        $command = $data['command'] ? $data['command'] : '';
        $user = $userRepository->findOneBySomeField($email);
        if (!empty($user) && !empty($command)){
            if ($command === 'product'){
                $result = $productRepository->findAll();
            }
            elseif ($command === 'category'){
                $result = $categoryRepository->findAll();
            }
            else {
                return View::create('', Response::HTTP_BAD_REQUEST);
            }
            return View::create($result, Response::HTTP_OK);
        }

        return View::create('', Response::HTTP_FORBIDDEN);

    }

}
