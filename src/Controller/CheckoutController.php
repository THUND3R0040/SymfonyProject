<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    #[Route('/checkout/{totalPrice}/{nbItems}', name: 'app_checkout')]
    public function index($nbItems,$totalPrice,Request $request): Response
    {
        $session = $request->getSession();
        return $this->render('checkout/index.html.twig',[
            'nbItems'=>$nbItems,
            'totalPrice'=>$totalPrice,
            'email'=>$session->get('u_email')]);
    }

    #[Route('/addOrder', name: 'addOrder')]
    public function addOrder(Request $request,EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $order = new Order();
        $order->setEmail($session->get('u_email'));
        $order->setTotal($request->get('totalPrice'));
        $order->setNbItems($request->get('nbItems'));
        $order->setOrderDate(new \DateTime('now'));

        $entityManager->persist($order);
        $entityManager->flush();
        return $this->redirectToRoute('app_productPage');
    }
}



