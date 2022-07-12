<?php

namespace App\Repository;

use App\Entity\BricoleursElectriciens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BricoleursElectriciens>
 *
 * @method BricoleursElectriciens|null find($id, $lockMode = null, $lockVersion = null)
 * @method BricoleursElectriciens|null findOneBy(array $criteria, array $orderBy = null)
 * @method BricoleursElectriciens[]    findAll()
 * @method BricoleursElectriciens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BricoleursElectriciensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BricoleursElectriciens::class);
    }

    public function add(BricoleursElectriciens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BricoleursElectriciens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BricoleursElectriciens[] Returns an array of BricoleursElectriciens objects
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

//    public function findOneBySomeField($value): ?BricoleursElectriciens
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
