<?php

namespace App\Repository;

use App\Entity\BricoleursJardiniers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BricoleursJardiniers>
 *
 * @method BricoleursJardiniers|null find($id, $lockMode = null, $lockVersion = null)
 * @method BricoleursJardiniers|null findOneBy(array $criteria, array $orderBy = null)
 * @method BricoleursJardiniers[]    findAll()
 * @method BricoleursJardiniers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BricoleursJardiniersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BricoleursJardiniers::class);
    }

    public function add(BricoleursJardiniers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BricoleursJardiniers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BricoleursJardiniers[] Returns an array of BricoleursJardiniers objects
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

//    public function findOneBySomeField($value): ?BricoleursJardiniers
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
