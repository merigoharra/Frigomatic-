<?php

namespace App\Repository;

use App\Entity\UserProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserProduct[]    findAll()
 * @method UserProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserProduct::class);
    }

    /**
    * @return UserProduct[] Returns an array of UserProduct objects
    */
    public function findByOldestUpdate($user)
    {
        return $this->createQueryBuilder('u')
            ->join('u.product', 'p')
            ->where('p.urgent ='.'1')
            ->andWhere('u.user ='.$user)
            ->orderBy('u.updated_at', 'ASC')
            ->setMaxResults(30)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?UserProduct
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
