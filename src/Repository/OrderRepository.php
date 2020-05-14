<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
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

     /**
      * @return Order[] Returns an array of Order objects
      */

    public function index()
    {
        return $this->createQueryBuilder('o')
            ->addOrderBy('o.accept','ASC')
            ->addOrderBy('o.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Order[] Returns an array of Order objects
     */

    public function listDay($fromDate,$toDate) : array
    {

        return $this->createQueryBuilder('o')
            ->select('o.fromDate','o.toDate')
            ->andWhere('o.fromDate >= :form_date AND o.toDate <= :to_date')
            ->setParameter('form_date',$fromDate)
            ->setParameter('to_date',$toDate)
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
