<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

//    /**
//     * @return Order[] Returns an array of Order objects
//     */
    public function thirtyDaysOrders(EntityManagerInterface $entityManager){
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('o')
            ->from(Order::class, 'o')
            ->where($queryBuilder->expr()->between('o.orderDate', ':startDate', ':endDate'))
            ->setParameter('startDate', date('Y-m-d', strtotime('-30 days')))
            ->setParameter('endDate', date('Y-m-d'));

        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

//    public function findOneBySomeField($value): ?Order
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
