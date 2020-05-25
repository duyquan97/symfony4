<?php
namespace App\Controller;

use App\Form\ArticleFormType;
use App\Form\UserSelectTextType;
use App\Updates\SiteUpdateManager;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address;
use App\Service\A;
use App\Service\A2;
use App\Service\C;
use App\Service\TestService;

    class BController extends AbstractController
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

        /**
         * @Route("/autowiring")
         */
        public function autowiring(C $c){
            $a =1;
            $b =2;
            dd($c->test($a,$b));



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