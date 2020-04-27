<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @return Category[] Returns an array of Category objects
     */

    public function show($id)
    {
         $data =$this->createQueryBuilder('p')
            ->Where('p.id = :id')
            ->setParameter('id', $id)
            ->select('p.id','p.name','p.price', 'c.name as category')
            ->leftJoin(Category::class, 'c', Join::WITH, 'c.id = p.category_id' )
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
         return $data;

    }

    /**
     * @return Category[] Returns an array of Category objects
     */

    public function index()
    {
        $data =$this->createQueryBuilder('p')
            ->select('p.id','p.name','p.price', 'c.name as category')
            ->leftJoin(Category::class, 'c', Join::WITH, 'c.id = p.category_id' )
            ->getQuery()
            ->getResult();
        return $data;

    }


    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
