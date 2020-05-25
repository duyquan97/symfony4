<?php
namespace App\Service;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
class Mailer
{
    private $transport;
    public function __construct($transport)
    {
        $this->transport = $transport;
    }

}
