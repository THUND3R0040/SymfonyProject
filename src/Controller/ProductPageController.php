<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductPageController extends AbstractController
{
    #[Route('/productPage', name: 'app_productPage')]
    public function index(): Response
    {
        return $this->render('product_page/index.html.twig', [
            'controller_name' => 'ProductPageController',
        ]);
    }
}
