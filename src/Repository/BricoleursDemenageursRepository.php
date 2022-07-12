<?php

namespace App\Repository;

use App\Entity\BricoleursDemenageurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BricoleursDemenageurs>
 *
 * @method BricoleursDemenageurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method BricoleursDemenageurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method BricoleursDemenageurs[]    findAll()
 * @method BricoleursDemenageurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BricoleursDemenageursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BricoleursDemenageurs::class);
    }

    public function add(BricoleursDemenageurs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BricoleursDemenageurs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BricoleursDemenageurs[] Returns an array of BricoleursDemenageurs objects
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

//    public function findOneBySomeField($value): ?BricoleursDemenageurs
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
