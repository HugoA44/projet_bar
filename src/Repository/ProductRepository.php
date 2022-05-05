<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */

    public function findByProductType($value): ?Product
    {
        return $this->createQueryBuilder('p')
        ->where('p.type = :type')
        ->setParameter('type', $value)
        ->getQuery()
        ->execute();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */

    public function findByCategory($value): ?Product
    {
        return $this->createQueryBuilder('p')
        ->where('p.TypeCategory = :type')
        ->setParameter('type', $value)
        ->getQuery()
        ->execute();
    }

}
