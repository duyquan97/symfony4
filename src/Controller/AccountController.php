<?php
namespace App\Controller;

use App\Updates\SiteUpdateManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address;
use App\Service\MessageGenerator;

class AccountController extends AbstractController
{
    private $adminEmail;
    public function __construct($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }


    /**
     * @Route("/email")
     */
    public function sendEmail(MailerInterface $mailer) {

        $email = (new Email())
            ->from('duyquan130497@gmail.com')
            ->to('duyquan627@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        dd(123);
    }
    /**
     * @Route("/servicetest")
     */
    public function new(MessageGenerator $messageGenerator) {
        $message = $messageGenerator->getHappyMessage();
        dd($message);
        $this->addFlash('success', $message);
    }

    /**
     * @Route("/servicetest2")
     */
    public function test(SiteUpdateManager $siteUpdateManager) {

        $data = $siteUpdateManager->notifyOfSiteUpdate();
        if ($data) {
            dd($data);
        }
    }

}