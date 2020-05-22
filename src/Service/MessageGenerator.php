<?php
namespace App\Service;
use Michelf\MarkdownInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
class MessageGenerator
{
    private $mailer_password;
    private $logger;
    private $test;
    private $container;

    public function __construct( $logger , $mailer_password, $test, ContainerInterface $container)
    {
        $this->logger = $logger;
        $this->mailer_password = $mailer_password;
        $this->test = $test;
        $this->container = $container;

    }

    public function getHappyMessage()
    {
        if ($this->container->has('service.test')){
            dd($this->container->get('service.test')->getHappyMessage());
        }
        dd($this->test->getHappyMessage());
        $this->logger->info('About to find a happy message!');
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

}
