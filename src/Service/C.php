<?php
namespace App\Service;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
class C
{
    private $a;
    public function __construct(A2 $a)
    {
        $this->a = $a;
    }

    public function test($a, $c)
    {
        return $this->a->index($c);
    }

}
