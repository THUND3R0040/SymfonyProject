<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
    public function last30DaysUsers(EntityManagerInterface $entityManager)
    {
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('u')
            ->from(User::class, 'u')
            ->where($queryBuilder->expr()->between('u.regDate', ':startDate', ':endDate'))
            ->setParameter('startDate', date('Y-m-d', strtotime('-30 days')))
            ->setParameter('endDate', date('Y-m-d'));

        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    /**
     * @throws Exception
     */
    public function userWithSpent(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $query = "
        SELECT u_name AS name, u_email AS email, COUNT(order_date) AS nbOrders, IFNULL(SUM(total), 0) AS totalSpent 
        FROM user u 
        LEFT JOIN `order` o ON o.email = u.u_email 
        GROUP BY u.u_email";
        $resultSet = $conn->executeQuery($query);
        return $resultSet->fetchAllAssociative();

    }


//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
