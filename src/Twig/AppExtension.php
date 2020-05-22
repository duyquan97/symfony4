<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
            new TwigFilter('notEmpty', [$this, 'notEmpty']),
        ];
    }

    public function formatPrice($number, $decimals = 0)
    {
        $price = number_format($number,$decimals,'.',',');
        return $price;
    }
    public function notEmpty($val){
       $bool = !empty($val) ? true : false;
        return $bool;
    }
}
