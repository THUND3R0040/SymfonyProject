<?php

namespace App\Repository;

use App\Entity\Month;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Month>
 *
 * @method Month|null find($id, $lockMode = null, $lockVersion = null)
 * @method Month|null findOneBy(array $criteria, array $orderBy = null)
 * @method Month[]    findAll()
 * @method Month[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Month::class);
    }

//    /**
//     * @return Month[] Returns an array of Month objects
//     */
// src/Repository/ProductRepository.php

// ...

    /**
     * @throws Exception
     */
    public function incomeByMonth(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT MONTH(m.month) AS mOrder, IFNULL(SUM(o.total), 0) AS total_num
        FROM month m
        LEFT JOIN `order` o ON MONTH(m.month) = MONTH(o.order_date)
        GROUP BY mOrder
        ORDER BY mOrder ASC";

        $resultSet = $conn->executeQuery($sql);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }


    /**
     * @throws Exception
     */
    public function ordersByMonth(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT MONTH(m.month) AS mOrder, IFNULL(COUNT(o.total), 0) AS total_num
        FROM month m
        LEFT JOIN `order` o ON MONTH(m.month) = MONTH(o.order_date)
        GROUP BY mOrder
        ORDER BY mOrder ASC";

        $resultSet = $conn->executeQuery($sql);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();

    }

//    public function findOneBySomeField($value): ?Month
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
