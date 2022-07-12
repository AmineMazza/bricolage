<?php

namespace App\Repository;

use App\Entity\BricoleursMinuisiers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BricoleursMinuisiers>
 *
 * @method BricoleursMinuisiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method BricoleursMinuisiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method BricoleursMinuisiers[]    findAll()
 * @method BricoleursMinuisiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BricoleursMinuisiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BricoleursMinuisiers::class);
    }

    public function add(BricoleursMinuisiers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BricoleursMinuisiers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BricoleursMinuisiers[] Returns an array of BricoleursMinuisiers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BricoleursMinuisiers
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
