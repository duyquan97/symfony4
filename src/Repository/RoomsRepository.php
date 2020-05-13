<?php

namespace App\Repository;

use App\Entity\Rooms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rooms|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rooms|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rooms[]    findAll()
 * @method Rooms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rooms::class);
    }

     /**
      * @return Rooms[] Returns an array of Rooms objects
      */

    public function search($keyWord,$fromDate,$toDate,$type)
    {
        $data = $this->createQueryBuilder('r');
        if (!empty($keyWord)){
            $data = $data->andWhere('r.name LIKE :val OR r.province LIKE :val OR r.street LIKE :val OR r.district LIKE :val')
                ->setParameter('val', '%'.$keyWord.'%');
        }
        if (!empty($type)){
            $data = $data->andWhere('r.type = :type')
                ->setParameter('type', $type);
        }
        $data = $data->orderBy('r.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
            return $data;
    }


    /*
    public function findOneBySomeField($value): ?Rooms
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
