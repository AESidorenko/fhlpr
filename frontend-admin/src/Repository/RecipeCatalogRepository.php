<?php

namespace App\Repository;

use App\Entity\RecipeCatalog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecipeCatalog>
 *
 * @method RecipeCatalog|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeCatalog|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeCatalog[]    findAll()
 * @method RecipeCatalog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeCatalogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeCatalog::class);
    }

    public function add(RecipeCatalog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RecipeCatalog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RecipeCatalog[] Returns an array of RecipeCatalog objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RecipeCatalog
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function findAllRootChildren()
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.parent IS NULL')
            ->getQuery()
            ->getResult()
        ;
    }
}
