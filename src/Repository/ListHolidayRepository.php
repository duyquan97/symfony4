<?php

namespace App\Repository;

use App\Entity\ListHoliday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListHoliday|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListHoliday|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListHoliday[]    findAll()
 * @method ListHoliday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListHolidayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListHoliday::class);
    }

    // /**
    //  * @return ListHoliday[] Returns an array of ListHoliday objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListHoliday
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
