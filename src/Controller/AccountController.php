<?php
namespace App\Controller;

use App\Form\ArticleFormType;
use App\Form\UserSelectTextType;
use App\Service\CService;
use App\Updates\SiteUpdateManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address;
use App\Service\MessageGenerator;

class AccountController extends AbstractController
{
    private $adminEmail;
    private $mailer;
    private $messageGenerator;


    public function __construct($adminEmail, MailerInterface $mailer,MessageGenerator $messageGenerator)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
        $this->messageGenerator = $messageGenerator;
    }


    /**
     * @Route("/email")
     */
    public function sendEmail() {
        $email =
        $email = (new Email())
            ->from('duyquan130497@gmail.com')
            ->to('duyquan627@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
        dd(123);
    }
    /**
     * @Route("/servicetest")
     */
    public function new() {
        $message = $this->messageGenerator->getHappyMessage();
        dd($message);
        $this->addFlash('success', $message);
    }

    /**
     * @Route("/servicetest2")
     */
    public function test(SiteUpdateManager $siteUpdateManager) {
        $data = $siteUpdateManager->notifyOfSiteUpdate();
        dd($data);
        if ($data) {
            dd($data);
        }
    }

    /**
     * @Route("/transform")
     */
    public function transForm(Request $request) {
        dd(__DIR__);

        $form = $this->createForm(UserSelectTextType::class);
        $form->handleRequest($request);

        return $this->render('account/index.html.twig',[
           'form' => $form->createView()
        ]);
    }

}