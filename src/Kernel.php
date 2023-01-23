<?php

namespace App;

//use Nelmio\ApiDocBundle\NelmioApiDocBundle;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;


    // public function registerBundles(): is_iterable
    // {
    //     $bundles=[
    //         new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
    //     ];

    
    // }

}
