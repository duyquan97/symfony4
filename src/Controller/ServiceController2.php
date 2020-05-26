<?php
namespace App\Controller;

use App\Form\ArticleFormType;
use App\Form\UserSelectTextType;
use App\Service\CService;
use App\Service\TestService;
use App\Updates\SiteUpdateManager;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address;
use App\Service\A;


    class ServiceController2 extends AbstractController
    {
//        private $c;
//
//        public function __construct(C $c)
//        {
//            $this->c = $c;
//        }
//
//        /**
//         * @Route("/test/b")
//         */
//        public function index2(C $c, ContainerInterface $container )
//        {
//           $test =  $container->get('service.c')->test();
//            dd($this->c->test());
//        }

        private $serviceC;
        public function __construct(CService $serviceC)
        {
            $this->serviceC = $serviceC;
        }

        /**
         * @Route("/autowiring")
         */
        public function autowiring(ContainerInterface $container){
            dd($container->get('service.a')->test(new TestService()));
            dd($this->serviceC->test());

        }


//    private $a;
//
//    public function setA(A $a) {
//        $this->a = $a;
//    }
//        /**
//         * @Route("/test/b")
//         */
//    public function index2() {
//       $b = new BController();
//       $b->setA(new A());
//       dd($b->a->index());
//    }




}