<?php
namespace App\Service;

class CService
{
    private $demoService;
    public function __construct( DemoService $demoService)
    {
        $this->demoService = $demoService;

    }

    public function test()
    {
        return $this->demoService->index();
    }

}
