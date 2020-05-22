<?php
namespace App\Service;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
class TestService
{
    public function getHappyMessage()
    {
        return 'xin chao';
    }

}
