<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recipe::class);
    }


    // SELECT recipe_id FROM `recipe_product` WHERE `product_id` IN (SELECT `product_id` FROM `user_product` WHERE `user_id` = 1) GROUP BY recipe_id HAVING COUNT(product_id) > 4


    /**
     * @return Recipe[] Returns an array of Recipe objects
     */
    public function findMyPersonalRecipe($user, $entityManager)
    {
        $rsm = new ResultSetMapping();

        $query = $entityManager->createNativeQuery('SELECT recipe_id FROM `recipe_product` WHERE `product_id` IN (SELECT `product_id` FROM `user_product` WHERE `user_id` = 1) GROUP BY recipe_id HAVING COUNT(product_id) > 2', $rsm);
        $query->setParameter(1, $user);

        return $query->getResult();

    }

    /*
    public function findOneBySomeField($value): ?Recipe
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
