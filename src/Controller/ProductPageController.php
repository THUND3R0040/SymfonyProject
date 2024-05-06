<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;

use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Json;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
class ProductPageController extends AbstractController
{
    #[Route('/productPage', name: 'app_productPage')]
    public function index(ManagerRegistry $doctrine, Request $request,SessionInterface $session,EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $cartItems = [];
        if($session->has("u_email")){
            $cartItems = $doctrine->getRepository(Cart::class)->cartItemsForEmail($entityManager,$session->get("u_email"));

        }
        return $this->render('product_page/index.html.twig',
            ["cartItems" => $cartItems]
        );
    }





    #[Route('/filter', name: 'filterProduct', methods: ['POST'])]
    public function filter(Request $req, ManagerRegistry $doctrine,LoggerInterface $logger)
    {


        $prod = [];
        $filters = $req->getContent();

        $filters = json_decode($filters, true);

        $filter = $filters['filter'];
        $genre = $filters['genre'];


        if ($genre === "everyone") {
            if ($filter === "all") {
                $prod = $doctrine->getRepository(Product::class)->findAll();
            } elseif ($filter === "bs") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_bs' => 'true']);
            } elseif ($filter === "ft") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_ft' => 'true']);
            }
        } elseif ($genre === "kid") {
            if ($filter === "all") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_type' => 'kids']);
            } elseif ($filter === "bs") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_type' => 'kids','p_bs' => 'true']);
            } elseif ($filter === "ft") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_type' => 'kids', 'p_ft' => 'true']);
            }
        } elseif ($genre === "man") {
            if ($filter === "all") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_type' => 'men']);
            } elseif ($filter === "bs") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_type' => 'men', 'p_bs' => 'true']);
            } elseif ($filter === "ft") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_type' => 'men', 'p_ft' => 'true']);
            }
        } elseif ($genre === "women") {
            if ($filter === "all") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_type' => 'women']);
            } elseif ($filter === "bs") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_type' => 'women', 'p_bs' => 'true']);
            } elseif ($filter === "ft") {
                $prod = $doctrine->getRepository(Product::class)->findBy(['p_type' => 'women', 'p_ft' => 'true']);
            }
        }
        $htmlc = "";
        $response = new Response();
        foreach ($prod as $row) {
            $p_overlay = $row->getPOverlay();
            $p_img = $row->getPImg();
            $p_name = $row->getPName();
            $p_price = $row->getPPrice();
            $p_doc = $row->getPDoc();
            $p_type = $row->getPType();
            $p_bs = $row->getPBS();
            $p_ft = $row->getPFT();

            $htmlc .= "<div class='pr' style='position: static;'>
            <div class='overlay' style='background-image: url(assets/productPage/$p_overlay);'></div>
            <img class='pro' src='assets/productPage/$p_img'>
            <span class='lorem'>$p_name</span>
            <span class='price'>$p_price</span>
            <input type='hidden' name='p_name' value='$p_name' class='hiddenName'>
            <input type='hidden' name='p_price' value='$p_price'>
            <input type='hidden' name='p_img' value='assets/productPage/$p_img'>
            <input type='hidden' name='p_doc' value='$p_doc'>
            <input type='hidden' name='p_type' value='$p_type'>
            <input type='hidden' name='p_ft' value='$p_ft'>
            <input type='hidden' name='p_bs' value='$p_bs'>
            <button class='glow-on-hover'>Buy</button>
        </div>";
        }
        $response->setContent($htmlc);
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');
        return $response;
    }


    #[Route('/cart', name: 'cart', methods: ['POST'])]
    function cart (Request $req, ManagerRegistry $doctrine):Response
    {
        $session = $req->getSession();
        $response = new Response();
        $dateString = date('Y-m-d');
        $date = \DateTime::createFromFormat('Y-m-d', $dateString);
        $reqContent = $req->getContent();
        $Json = json_decode($reqContent, true);
        $productid = $Json['product_id'];


        if($session->get('u_email') === null){
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
            return $response;
        }
        else{
            $email = $session->get('u_email');
            $cart = new Cart();
            $t = time();
            $cart->setCommId($t);
            $cart->setPName($productid);
            $cart->setAddDate($date);
            $cart->setUEmail($email);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($cart);
            $entityManager->flush();
            $response->setStatusCode(Response::HTTP_OK);
            return $response;
        }

    }


}



















