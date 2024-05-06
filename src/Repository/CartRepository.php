<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }




//    /**
//     * @return Cart[] Returns an array of Cart objects
//     */


    public function cartItemsForEmail (EntityManagerInterface $entityManager,string $email)
    {
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('product')
            ->from(Cart::class, 'cart')
            ->join('App\Entity\Product', 'product','With','product.p_name = cart.p_name')
            ->join('App\Entity\User', 'user','With','cart.u_email = user.u_email')
            ->where('user.u_email = :email')
            ->setParameter('email', $email);
        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }

//    public function findOneBySomeField($value): ?Cart
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
