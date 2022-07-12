<?php

namespace App\Repository;

use App\Entity\BricoleursPlombiers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BricoleursPlombiers>
 *
 * @method BricoleursPlombiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method BricoleursPlombiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method BricoleursPlombiers[]    findAll()
 * @method BricoleursPlombiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BricoleursPlombiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BricoleursPlombiers::class);
    }

    public function add(BricoleursPlombiers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BricoleursPlombiers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BricoleursPlombiers[] Returns an array of BricoleursPlombiers objects
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

//    public function findOneBySomeField($value): ?BricoleursPlombiers
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
