<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ProductPageController extends AbstractController
{
    #[Route('/productPage', name: 'app_productPage')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $prod = $doctrine->getRepository(Product::class)->findAll();

        return $this->render('product_page/index.html.twig', [
            'products' => $doctrine->getRepository(Product::class)->findAll(),
        ]);
    }

    #[Route('/product', name: 'app_product')]
    public function filter():Response{




        $html = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filter = $_POST['filter'];
            $genre = $_POST['genre'];
            if ($genre === "everyone") {
                if ($filter === "all") {
                    $sql = "SELECT * FROM product";
                } elseif ($filter === "bs") {
                    $sql = "SELECT * FROM product WHERE p_bs='true'";
                } elseif ($filter === "ft") {
                    $sql = "SELECT * FROM product WHERE p_ft='true'";
                }
            } elseif ($genre === "kid") {
                if ($filter === "all") {
                    $sql = "SELECT * FROM product WHERE p_type='kids'";
                } elseif ($filter === "bs") {
                    $sql = "SELECT * FROM product WHERE p_bs='true' AND p_type='kids'";
                } elseif ($filter === "ft") {
                    $sql = "SELECT * FROM product WHERE p_ft='true' AND p_type='kids'";
                }
            } elseif ($genre === "man") {
                if ($filter === "all") {
                    $sql = "SELECT * FROM product WHERE p_type='men'";
                } elseif ($filter === "bs") {
                    $sql = "SELECT * FROM product WHERE p_bs='true' AND p_type='men'";
                } elseif ($filter === "ft") {
                    $sql = "SELECT * FROM product WHERE p_ft='true' AND p_type='men'";
                }
            } elseif ($genre === "women") {
                if ($filter === "all") {
                    $sql = "SELECT * FROM product WHERE p_type='women'";
                } elseif ($filter === "bs") {
                    $sql = "SELECT * FROM product WHERE p_bs='true' AND p_type='women'";
                } elseif ($filter === "ft") {
                    $sql = "SELECT * FROM product WHERE p_ft='true' AND p_type='women'";
                }
            }

            $stmt = $conn->prepare($sql);
            $stmt->execute();


            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $p_overlay = $row['p_overlay'];
                    $p_img = $row['p_img'];
                    $p_name = $row['p_name'];
                    $p_price = $row['p_price'];
                    $p_doc = $row['p_doc'];
                    $p_type = $row['p_type'];
                    $p_ft = $row['p_ft'];
                    $p_bs = $row['p_bs'];

                    $html .= "<div class='pr' style='position: static;'>
            <div class='overlay' style='background-image: url($p_overlay);'></div>
            <img class='pro' src='$p_img'>
            <span class='lorem'>$p_name</span>
            <span class='price'>$p_price</span>
            <input type='hidden' name='p_name' value='$p_name' class='hiddenName'>
            <input type='hidden' name='p_price' value='$p_price'>
            <input type='hidden' name='p_img' value='$p_img'>
            <input type='hidden' name='p_doc' value='$p_doc'>
            <input type='hidden' name='p_type' value='$p_type'>
            <input type='hidden' name='p_ft' value='$p_ft'>
            <input type='hidden' name='p_bs' value='$p_bs'>
            <button class='glow-on-hover'>Buy</button>
        </div>
        ";
                }
            } else {
                $html = "<h3>No products found</h3>";
            }
            echo $html;
        }

    }




}
