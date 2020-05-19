<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\Rooms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use mysql_xdevapi\DatabaseObject;
use Symfony\Component\HttpFoundation\Session\Session;

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

    public function index( $user)
    {
        $data =$this->createQueryBuilder('o');
        if (!empty($user)) {
            $data = $data->andWhere('o.user = :user')
                ->setParameter('user',$user);
        }
        $data = $data->addOrderBy('o.accept','ASC')
            ->addOrderBy('o.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
        return  $data;
    }

    /**
     * @return Order[] Returns an array of Order objects
     */

    public function checkBooking(\DateTimeInterface $fromDate, \DateTimeInterface $toDate, $room) : array
    {
        $now = date_create(date('Y-m-d',strtotime("now")));
        return $this->createQueryBuilder('o')
            ->select('o.fromDate','o.toDate')
            ->andWhere('o.fromDate >= :form_date AND  o.toDate >= :to_date AND o.fromDate <= :to_date')
            ->orWhere('o.fromDate <= :form_date AND  o.toDate >= :to_date')
            ->orWhere('o.fromDate <= :form_date AND  o.toDate <= :to_date AND o.toDate >= :form_date')
            ->orWhere('o.fromDate >= :form_date AND  o.toDate <= :to_date ')
            ->andWhere(' o.room = :room AND o.toDate >= :now')
            ->setParameter('form_date',$fromDate)
            ->setParameter('to_date',$toDate)
            ->setParameter('room',$room)
            ->setParameter('now',$now)
            ->getQuery()
            ->getResult()
            ;
    }
    public function listBooking(\DateTimeInterface $now, $room) : array
    {

        return $this->createQueryBuilder('o')
            ->andWhere('o.toDate >= :now AND o.room = :room ')
            ->setParameter('now',$now)
            ->setParameter('room',$room)
            ->orderBy('o.toDate','ASC')
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
