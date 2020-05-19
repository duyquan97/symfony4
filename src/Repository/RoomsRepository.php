<?php

namespace App\Repository;

use App\Entity\Rooms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use mysql_xdevapi\DatabaseObject;
use Symfony\Component\HttpFoundation\Session\Session;

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

    public function search($keyWord,  $fromDate,  $toDate,  $type)
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



    public function findOneBySlug(string $slug): ?Rooms
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.slug = :val')
            ->setParameter('val', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findById($id)
    {
        $data = $this->createQueryBuilder('r');
        if (!empty($id)) {
            $data = $data
                ->andWhere('r.id = :id')
                ->setParameter('id', $id);
        }
        $data = $data
            ->orderBy('r.id','DESC');
        return $data;
    }

}
