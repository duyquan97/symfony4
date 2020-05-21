<?php
namespace App\Generator;

use Psr\Container\ContainerInterface;

class MessageGenerator
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function generate(string $message, string $template = null, array $context = []): string
    {
        if ($template && $this->container->has('twig')) {
            $twig = $this->container->get('twig');

            return $twig->render($template, $context + ['message' => $message]);
        }


    }
}