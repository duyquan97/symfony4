<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

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
     * @return Product[] Returns an array of Category objects
     */

    public function show($id)
    {
         $data =   $this->createQueryBuilder('p')
                        ->where('p.id = :id')
                        ->setParameter('id', $id)
                        ->select('p.id','p.name','p.price', 'c.name as category')
                        ->leftJoin(Category::class, 'c', Join::WITH, 'c.id = p.category_id' )
                        ->setMaxResults(1)
                        ->getQuery()
                        ->getResult();
         return $data;

    }

    /**
     * @return Product[] Returns an array of Category objects
     */
    public function filterData($name,$category,$price_min,$price_max)
    {
       $data = $this->createQueryBuilder('p');

        if (!empty($name)) {
            $data = $data->andWhere('p.name like :name')->setParameter('name', '%'.$name.'%');
        }
        if (!empty($category)) {

            $data  = $data->andWhere('p.category_id = :category')->setParameter('category', $category);
        }
        if (!empty($price_min) && !empty($price_max)) {
            $min  = $price_min;
            $max  = $price_max;
            $data = $data->andWhere('p.price BETWEEN :min AND :max')->setParameter('min', $min)->setParameter('max', $max);
        }
        $data = $data
            ->select('p.id','p.code','p.name','p.price','p.discount','p.producer','p.image','p.featured','p.status','c.name as category')                ->leftJoin(Category::class, 'c', Join::WITH, 'c.id = p.category_id' )
            ->getQuery()
            ->getResult();
        return $data;
    }


    /**
     * @return Product[] Returns an array of Category objects
     */
    public function index()
    {
        $data = $this->createQueryBuilder('p')
            ->select('p.id','p.code','p.name','p.price','p.discount','p.producer','p.image','p.featured','p.status','c.name as category')
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
