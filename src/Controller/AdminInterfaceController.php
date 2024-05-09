<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Comment;
use App\Entity\Month;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminInterfaceController extends AbstractController
{
    #[Route('/adminInterface', name: 'app_admin_interface')]
    public function index(): Response
    {
        return $this->render('admin_interface/index.html.twig');
    }


    /**
     * @throws Exception
     */
    #[Route('/dashboardQueries', name: 'app_admin',methods:['POST'])]
    public function adminDashboard(ManagerRegistry $doctrine,EntityManagerInterface $manager): Response
    {
        $last30DaysOrders = 0;
        $numberOfOrders = 0;
        $orders = $doctrine->getRepository(Order::class)->thirtyDaysOrders($manager);
        foreach($orders as $order){
            $last30DaysOrders += $order->getTotal();
            $numberOfOrders += 1;
        }
        $totalIncome = 0;
        $dailyIncome = 0;
        $orders = $doctrine->getRepository(Order::class)->findAll();
        foreach($orders as $order){
            $totalIncome += $order->getTotal();
            if($order->getOrderDate()===new \DateTime('now')){
                $dailyIncome += $order->getTotal();
            }
        }

        $last30DaysUsers = 0;
        $users = $doctrine->getRepository(User::class)->last30DaysUsers($manager);
        $last30DaysUsers = sizeof($users);

        $incomes = [];
        $incomeByMonth = $doctrine->getRepository(Month::class)->incomeByMonth();

        foreach($incomeByMonth as $i){
            $incomes[] = intval($i['total_num']);
        }

        $nbOrders = [];
        $ordersByMonth = $doctrine->getRepository(Month::class)->ordersByMonth();

        foreach($ordersByMonth as $i){
            $nbOrders[] = $i['total_num'];
        }

        $htmlContent = "
        <article class='stats'>
        <div class='card'>
            <div class='info'>
                <span>New Orders</span>
                <span>$numberOfOrders</span>
                <span>(Last 30 days)</span>
            </div>
            
            <span class='bg'>
                <img width='46px' height='46px' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAADtUlEQVR4nO2ZX0ibVxiHD7sQul7uejeL2pjUzGgnatJoZk21ybqMzpVOm6pzabO5C7uJri1k2M6kWhwdUtrBUIedhQodZsQyrSZe7Lr1Rga7Tad325oJXsxnnExGWlDzp0m/5fseeODjnDe/94WcwCGfEBoaGhoaGhoaGhpPYWilSHeOqzofj3U+2M3XzhHT+QjKz4hC4cBZggfOQpoGRKFg9BIzesH4IXV71Rq8WBO1XmKiUCjvJmbqBpMXayr1idpuEIWCuYtA5QeQrqJQMLRSVN1B4I0OYtWdkKpCrdSeAalQK4c9IBVqxd4OSrOhnZi9jWBrPu4nTW2gWN/Pw/2k+RRIhYJoPoV1e67c309cJ0EqFEbe5nK/B/kyk7lErjnxLuTLTOYSauXkCZAKNXLazStt70Cbm99z3szjhlyYzUyn3ZzfzpkXuabrOOTCTOfpPE5n11tsyoyOtzkm1EJ7E/u9Lia8Lkjo5IpQCz0u9D4nKx85wXeMDZ8Tb96af9IC2Zht/54WPD0txLfzVj9uoVzkk95myMaM+7ayr/cot5Kyvvu0if1CDZx3oP/MwUqfA/ocbPQ58njkXzT9jXgGGokPHIH+Rlb7j+T5yD/LpUZIRZElvTXsu/gmt5IylXHkv7BDKmbTw1+P3m9nReb47Wz47So68oN2PIP1xC83wGADq4O2F3zk84Ff8NKXVgxDNqYDNpAO2Rj3V/GyUBp+A0UjFq4OW3g8YoXn7bCF+IiFM0KpjNYR/MoCz9m/Ry38OlrHzWuHeVUomes1xL6uheu1e79LLEhu1IBUqJVvqkEq1Mq3h0Aq1MZkJa7JSpYmqyBhJeFxM83p5oxX0bCd89dEFfHJKhZltlAyU2YuTZnZum2GZOXaVAX+VHNum7n4bMZ/WRUK/UNj+nUa7lTA94fYHLpJ5PMo6xeWWZPPcm26gq07Jo7umWPCJWt3ypE9ZI1QGjPlLM2YYGyMyLUIJHtjjIjcmzER3jPH9G/tbjl3y3kglMY9I/EfDsL4fdYn5uEp77Mu99Jxt5x7B/lTKI2QkSchI4R+ZC00B8nOhvktsZeOu+TMGvlDKI1wGYtzZRAdJvLzLCQbDRKRe+EyQinkLO2VM6dX4E9gXo9rXg8LRjYfBoj8cpc16aMAEbn2k56tBT1NKeQ4E7U75MgeskYokaVSriyVwg4OpJqzWMKFnXIWS7kslMxyMa7lYh4s63gijRazEC3BlkFOfXKOfI6WKPSb19DQ0NDQ0NDQEP9//gHAG5VlZt1oLAAAAABJRU5ErkJggg=='>
            </span>
            </div>
        </div>

        <div class='card'>
            <div class='info'>
                <span>Total Income</span>
                <span>$totalIncome $</span>
                <span>Incresed by</span>
            </div>
            
            <span class='bg'>
                <img width='46px' height='46px' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAADtUlEQVR4nO2ZX0ibVxiHD7sQul7uejeL2pjUzGgnatJoZk21ybqMzpVOm6pzabO5C7uJri1k2M6kWhwdUtrBUIedhQodZsQyrSZe7Lr1Rga7Tad325oJXsxnnExGWlDzp0m/5fseeODjnDe/94WcwCGfEBoaGhoaGhoaGhpPYWilSHeOqzofj3U+2M3XzhHT+QjKz4hC4cBZggfOQpoGRKFg9BIzesH4IXV71Rq8WBO1XmKiUCjvJmbqBpMXayr1idpuEIWCuYtA5QeQrqJQMLRSVN1B4I0OYtWdkKpCrdSeAalQK4c9IBVqxd4OSrOhnZi9jWBrPu4nTW2gWN/Pw/2k+RRIhYJoPoV1e67c309cJ0EqFEbe5nK/B/kyk7lErjnxLuTLTOYSauXkCZAKNXLazStt70Cbm99z3szjhlyYzUyn3ZzfzpkXuabrOOTCTOfpPE5n11tsyoyOtzkm1EJ7E/u9Lia8Lkjo5IpQCz0u9D4nKx85wXeMDZ8Tb96af9IC2Zht/54WPD0txLfzVj9uoVzkk95myMaM+7ayr/cot5Kyvvu0if1CDZx3oP/MwUqfA/ocbPQ58njkXzT9jXgGGokPHIH+Rlb7j+T5yD/LpUZIRZElvTXsu/gmt5IylXHkv7BDKmbTw1+P3m9nReb47Wz47So68oN2PIP1xC83wGADq4O2F3zk84Ff8NKXVgxDNqYDNpAO2Rj3V/GyUBp+A0UjFq4OW3g8YoXn7bCF+IiFM0KpjNYR/MoCz9m/Ry38OlrHzWuHeVUomes1xL6uheu1e79LLEhu1IBUqJVvqkEq1Mq3h0Aq1MZkJa7JSpYmqyBhJeFxM83p5oxX0bCd89dEFfHJKhZltlAyU2YuTZnZum2GZOXaVAX+VHNum7n4bMZ/WRUK/UNj+nUa7lTA94fYHLpJ5PMo6xeWWZPPcm26gq07Jo7umWPCJWt3ypE9ZI1QGjPlLM2YYGyMyLUIJHtjjIjcmzER3jPH9G/tbjl3y3kglMY9I/EfDsL4fdYn5uEp77Mu99Jxt5x7B/lTKI2QkSchI4R+ZC00B8nOhvktsZeOu+TMGvlDKI1wGYtzZRAdJvLzLCQbDRKRe+EyQinkLO2VM6dX4E9gXo9rXg8LRjYfBoj8cpc16aMAEbn2k56tBT1NKeQ4E7U75MgeskYokaVSriyVwg4OpJqzWMKFnXIWS7kslMxyMa7lYh4s63gijRazEC3BlkFOfXKOfI6WKPSb19DQ0NDQ0NDQEP9//gHAG5VlZt1oLAAAAABJRU5ErkJggg=='>
            </span>
            </div>
        </div>

        <div class='card'>
            <div class='info'>
                <span>Daily Income</span>
                <span>$dailyIncome $</span>
                <span>Increased by</span>
            </div>
            
            <span class='bg'>
                <img width='46px' height='46px' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAADtUlEQVR4nO2ZX0ibVxiHD7sQul7uejeL2pjUzGgnatJoZk21ybqMzpVOm6pzabO5C7uJri1k2M6kWhwdUtrBUIedhQodZsQyrSZe7Lr1Rga7Tad325oJXsxnnExGWlDzp0m/5fseeODjnDe/94WcwCGfEBoaGhoaGhoaGhpPYWilSHeOqzofj3U+2M3XzhHT+QjKz4hC4cBZggfOQpoGRKFg9BIzesH4IXV71Rq8WBO1XmKiUCjvJmbqBpMXayr1idpuEIWCuYtA5QeQrqJQMLRSVN1B4I0OYtWdkKpCrdSeAalQK4c9IBVqxd4OSrOhnZi9jWBrPu4nTW2gWN/Pw/2k+RRIhYJoPoV1e67c309cJ0EqFEbe5nK/B/kyk7lErjnxLuTLTOYSauXkCZAKNXLazStt70Cbm99z3szjhlyYzUyn3ZzfzpkXuabrOOTCTOfpPE5n11tsyoyOtzkm1EJ7E/u9Lia8Lkjo5IpQCz0u9D4nKx85wXeMDZ8Tb96af9IC2Zht/54WPD0txLfzVj9uoVzkk95myMaM+7ayr/cot5Kyvvu0if1CDZx3oP/MwUqfA/ocbPQ58njkXzT9jXgGGokPHIH+Rlb7j+T5yD/LpUZIRZElvTXsu/gmt5IylXHkv7BDKmbTw1+P3m9nReb47Wz47So68oN2PIP1xC83wGADq4O2F3zk84Ff8NKXVgxDNqYDNpAO2Rj3V/GyUBp+A0UjFq4OW3g8YoXn7bCF+IiFM0KpjNYR/MoCz9m/Ry38OlrHzWuHeVUomes1xL6uheu1e79LLEhu1IBUqJVvqkEq1Mq3h0Aq1MZkJa7JSpYmqyBhJeFxM83p5oxX0bCd89dEFfHJKhZltlAyU2YuTZnZum2GZOXaVAX+VHNum7n4bMZ/WRUK/UNj+nUa7lTA94fYHLpJ5PMo6xeWWZPPcm26gq07Jo7umWPCJWt3ypE9ZI1QGjPlLM2YYGyMyLUIJHtjjIjcmzER3jPH9G/tbjl3y3kglMY9I/EfDsL4fdYn5uEp77Mu99Jxt5x7B/lTKI2QkSchI4R+ZC00B8nOhvktsZeOu+TMGvlDKI1wGYtzZRAdJvLzLCQbDRKRe+EyQinkLO2VM6dX4E9gXo9rXg8LRjYfBoj8cpc16aMAEbn2k56tBT1NKeQ4E7U75MgeskYokaVSriyVwg4OpJqzWMKFnXIWS7kslMxyMa7lYh4s63gijRazEC3BlkFOfXKOfI6WKPSb19DQ0NDQ0NDQEP9//gHAG5VlZt1oLAAAAABJRU5ErkJggg=='>
            </span>
            </div>
        </div>

        <div class='card'>
            <div class='info'>
                <span>New User</span>
                <span>$last30DaysUsers</span>
                <span>(Last 30 days)</span>
            </div>
            
            <span class='bg'>
                <img width='46px' height='46px' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAADtUlEQVR4nO2ZX0ibVxiHD7sQul7uejeL2pjUzGgnatJoZk21ybqMzpVOm6pzabO5C7uJri1k2M6kWhwdUtrBUIedhQodZsQyrSZe7Lr1Rga7Tad325oJXsxnnExGWlDzp0m/5fseeODjnDe/94WcwCGfEBoaGhoaGhoaGhpPYWilSHeOqzofj3U+2M3XzhHT+QjKz4hC4cBZggfOQpoGRKFg9BIzesH4IXV71Rq8WBO1XmKiUCjvJmbqBpMXayr1idpuEIWCuYtA5QeQrqJQMLRSVN1B4I0OYtWdkKpCrdSeAalQK4c9IBVqxd4OSrOhnZi9jWBrPu4nTW2gWN/Pw/2k+RRIhYJoPoV1e67c309cJ0EqFEbe5nK/B/kyk7lErjnxLuTLTOYSauXkCZAKNXLazStt70Cbm99z3szjhlyYzUyn3ZzfzpkXuabrOOTCTOfpPE5n11tsyoyOtzkm1EJ7E/u9Lia8Lkjo5IpQCz0u9D4nKx85wXeMDZ8Tb96af9IC2Zht/54WPD0txLfzVj9uoVzkk95myMaM+7ayr/cot5Kyvvu0if1CDZx3oP/MwUqfA/ocbPQ58njkXzT9jXgGGokPHIH+Rlb7j+T5yD/LpUZIRZElvTXsu/gmt5IylXHkv7BDKmbTw1+P3m9nReb47Wz47So68oN2PIP1xC83wGADq4O2F3zk84Ff8NKXVgxDNqYDNpAO2Rj3V/GyUBp+A0UjFq4OW3g8YoXn7bCF+IiFM0KpjNYR/MoCz9m/Ry38OlrHzWuHeVUomes1xL6uheu1e79LLEhu1IBUqJVvqkEq1Mq3h0Aq1MZkJa7JSpYmqyBhJeFxM83p5oxX0bCd89dEFfHJKhZltlAyU2YuTZnZum2GZOXaVAX+VHNum7n4bMZ/WRUK/UNj+nUa7lTA94fYHLpJ5PMo6xeWWZPPcm26gq07Jo7umWPCJWt3ypE9ZI1QGjPlLM2YYGyMyLUIJHtjjIjcmzER3jPH9G/tbjl3y3kglMY9I/EfDsL4fdYn5uEp77Mu99Jxt5x7B/lTKI2QkSchI4R+ZC00B8nOhvktsZeOu+TMGvlDKI1wGYtzZRAdJvLzLCQbDRKRe+EyQinkLO2VM6dX4E9gXo9rXg8LRjYfBoj8cpc16aMAEbn2k56tBT1NKeQ4E7U75MgeskYokaVSriyVwg4OpJqzWMKFnXIWS7kslMxyMa7lYh4s63gijRazEC3BlkFOfXKOfI6WKPSb19DQ0NDQ0NDQEP9//gHAG5VlZt1oLAAAAABJRU5ErkJggg=='>
            </span>
            </div>
        </div>
      </article>
      <article >
        <canvas id='myChart'></canvas>
      </article>
      <article >
        <canvas id='myChart1'></canvas>
      </article>
      <article>
        
      </article>
      ";

        $response = new JsonResponse();
        $response->setStatusCode(200);
        $data = [
            'msg'=>'dashboard',
            'html' => $htmlContent,
            'nbOrders'=>$nbOrders,
            'income'=>$incomes
        ];
        $response->setData($data);
        return $response;




    }


    /**
     * @throws Exception
     */
    #[Route('/usersQueries', name: 'users',methods:['POST'])]
    public function usersQueries ( ManagerRegistry $doctrine)
    {
        $users = $doctrine->getRepository(User::class)->userWithSpent();
        $html = "";
        foreach ($users as $row) {
            $html .= "
            <div class='swiper-slide'>
                <div class='edit'>edit Profile</div>
                <div class='profileInfo'>
                <div class='profileImgBg'>
                    <img src='/assets/admin/person.png'>
                </div>
                <div class='profileName'>
                    <div>".$row['name']."</div>
                    <div>".$row['email']."</div>
                </div>
                </div>
                <div class='profileStats'>
                <div>
                    <span >Spent</span><br>
                    <span >".$row['totalSpent']."$</span>
                </div>
                <div>
                    <span>Did</span><br>
                    <span >".$row['nbOrders']." orders</span>
                </div>
                <div class='delete' >delete</div>
                </div>
            </div>
            ";
        }
        if($html == ""){
            $htmlUsers = "<h1 class='noUsers'>No Users</h1>";
        }
    $response = new JsonResponse();
    $response->setStatusCode(200);
    $data = ["msg"=>"users", "html" => $html];
    $response->setData($data);
    return $response;
    }




    /**
     * @throws Exception
     */
    #[Route('/salesQueries', name: 'sales',methods:['POST'])]
    public function salesQueries ( ManagerRegistry $doctrine)
    {
        $orders = $doctrine->getRepository(Order::class)->findAll();
        $html = "
            <table class='shop_table my_account_orders'>
            <thead>
              <tr>
                <th class='order-number'>Order</th>
                <th class='order-date'>Date</th>
                <th class='order-total'>Total</th>
                <th class='order-actions'>Action</th>
              </tr>
            </thead>
            <tbody>
        ";

        foreach ($orders as $row) {
            $html .= "
                <tr class='order'>
                    <td class='order-number' data-title='Order'>
                        <a href='*'>#" . $row->getId() . "</a>
                    </td>
                    <td class='order-date' data-title='Date'>".
                        $row->getOrderDate()->format('d-m-Y')
                    ."</td>
                    <td class='order-total' data-title='Total'>
                        <span class='amount'>£" . $row->getTotal() . "</span> for " . $row->getNbItems() . " items
                    </td>
                    <td class='order-actions' data-title='Action'>
                        <img src='assets/admin/delete.png' width='50px' height='50px' class='deleteSales'>
                    </td>
                </tr>";
        }

        $html .= "</tbody></table>";
        $response = new JsonResponse();
        $response->setStatusCode(200);
        $data = ["msg"=>"sales", "html" => $html];
        $response->setData($data);
        return $response;
    }



    /**
     * @throws Exception
     */
    #[Route('/productsQueries', name: 'products',methods:['POST'])]
    public function productsQueries ( ManagerRegistry $doctrine)
    {
        $products = $doctrine->getRepository(Product::class)->findAll();
        $html = "";
        foreach ($products as $row) {
            $html .= "
    <div class='swiper-slide'>
        <div class='editProduct'>edit Product</div>
        <div class='productInfo'>
            <div class='productImg'>
                <img src='assets/productPage/" . $row->getPImg() . "'>
            </div>
            <div class='productName'>
                <div>" . $row->getPName() . "</div>
            </div>
        </div>
        <div class='productStats'>
            <div>
                <span>Type</span><br>
                <span>" . $row->getPType() . "</span>
            </div>
            <div>
                <span>Price</span><br>
                <span>" . $row->getPPrice() . "</span>
            </div>
            <div class='deleteProduct'>delete</div>
        </div>
    </div>";
        }

        if (empty($products)) {
            $html = "<h1 class='noProducts'>No Products</h1>";
        }

        $response = new JsonResponse();
        $response->setStatusCode(200);
        $data = ["msg"=>"products", "html" => $html];
        $response->setData($data);
        return $response;
    }


    #[Route('/commentsQueries', name: 'comments',methods:['POST'])]
    public function commentsQueries ( ManagerRegistry $doctrine)
    {
        $comments = $doctrine->getRepository(Comment::class)->findAll();

        $html = "<table class='shop_table my_account_orders'>
    <thead>
      <tr>
        <th class='order-number'>Comment</th>
        <th class='order-date'>Email</th>
        <th class='order-total'>Content</th>
        <th class='order-actions'>Action</th>
      </tr>
    </thead>
    <tbody>";

        foreach ($comments as $comment) {
            $commentId = htmlspecialchars($comment->getId());
            $email = htmlspecialchars($comment->getCEmail());
            $content = htmlspecialchars($comment->getCContent());

            $html .= "<tr class='order'>
        <td class='order-number' data-title='Comment'>
          <a href='*'>$commentId</a>
        </td>
        <td class='order-date' data-title='Email'>
          <time datetime='2014-06-12' title='1402562157'>$email</time>
        </td>
        <td class='order-total' data-title='Content'>
          <span class='amount'>$content</span>
        </td>
        <td class='order-actions' data-title='Action'>
          <img src='assets/admin/delete.png' width='50px' height='50px' class='deleteComment' data-comment-id='$commentId'>
        </td>
      </tr>";
        }

        $html.= "</tbody></table>";



        $response = new JsonResponse();
        $response->setStatusCode(200);
        $data = ["msg"=>"comments", "html" => $html];
        $response->setData($data);
        return $response;
    }

    #[Route('/logout', name: 'admin.logout')]
    public function logout(Request $request): Response
    {
        $request->getSession()->invalidate();
        return $this->redirectToRoute('app_login');
    }

    public function markCommentAnswered(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        // Find the comment by ID
        $comment = $entityManager->getRepository(Comment::class)->find($id);

        // Update the comment status
        $comment->setIsAnswered(true);
        $entityManager->flush();

        return new JsonResponse(['status' => 'success']);
    }

    public function deleteProductByName(Request $request, EntityManagerInterface $entityManager, $name): Response
    {
        // Find the product by name
        $product = $entityManager->getRepository(Product::class)->findOneBy(['name' => $name]);

        if (!$product) {
            return new JsonResponse(['status' => 'error', 'message' => 'Product not found']);
        }

        // Remove the product
        $entityManager->remove($product);
        $entityManager->flush();

        return new JsonResponse(['status' => 'success']);
    }

    public function deleteOrderByID(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        // Find the order by ID
        $order = $entityManager->getRepository(Order::class)->find($id);

        if (!$order) {
            return new JsonResponse(['status' => 'error', 'message' => 'Order not found']);
        }

        // Remove the order
        $entityManager->remove($order);
        $entityManager->flush();

        return new JsonResponse(['status' => 'success']);
    }

    #[Route('/deleteUser', name: 'deleteUser')]
    public function deleteUserByEmail(Request $request, EntityManagerInterface $entityManager): Response
    {
        $email = $request->getContent();
        $email=json_decode($email,true);
        $email=$email['userEmail'];
        // Find the user by email
        $user = $entityManager->getRepository(User::class)->findOneBy(['u_email' => $email]);

        if (!$user) {
            return new JsonResponse(['status' => 'error', 'message' => 'User not found']);
        }

        // Remove the user
        $entityManager->remove($user);
        $entityManager->flush();

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        return $response;
    }

    public function updateProductDetails(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Get request parameters

        $name = $request->request->get('name');
        $newName = $request->request->get('newName');
        $price = $request->request->get('newPrice');
        $type = $request->request->get('newType');

        // Find the product by name
        $product = $entityManager->getRepository(Product::class)->findOneBy(['name' => $name]);

        if (!$product) {
            return new JsonResponse(['status' => 'error', 'message' => 'Product not found']);
        }

        // Update product details
        $product->setName($newName);
        $product->setPrice($price);
        $product->setType($type);
        $entityManager->flush();

        return new JsonResponse(['status' => 'success']);
    }

    #[Route('/updateUser', name: 'updateuser')]
    public function updateUserDetails(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Get request parameters
        $res = $request->getContent();
        $resdecoded=json_decode($res,true);
        $email=$resdecoded['userEmail'];

        $newRole = trim($resdecoded['newRole']);
        $newName = trim($resdecoded['newName']);
        $newEmail = trim($resdecoded['newEmail']);
        // Find the user by email
        $user = $entityManager->getRepository(User::class)->findOneBy(['u_email' => $email]);

        if (!$user) {
            return new JsonResponse(['status' => 'error', 'message' => 'User not found']);
        }


        // Update user details
        if($newRole ==='admin') {
            $user->setIsAdmin(1);
        } else if ($newRole === 'user') {
            $user->setIsAdmin(0);
        }
        if ($newName!=="")
        {
            $user->setUName($newName);
        }

        if ($newEmail!=="") {
            $user->setUEmail($newEmail);
        }

        $entityManager->flush();


        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        return $response;
    }
}
