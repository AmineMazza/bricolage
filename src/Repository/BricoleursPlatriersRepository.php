<?php

namespace App\Repository;

use App\Entity\BricoleursPlatriers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BricoleursPlatriers>
 *
 * @method BricoleursPlatriers|null find($id, $lockMode = null, $lockVersion = null)
 * @method BricoleursPlatriers|null findOneBy(array $criteria, array $orderBy = null)
 * @method BricoleursPlatriers[]    findAll()
 * @method BricoleursPlatriers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BricoleursPlatriersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BricoleursPlatriers::class);
    }

    public function add(BricoleursPlatriers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BricoleursPlatriers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BricoleursPlatriers[] Returns an array of BricoleursPlatriers objects
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

//    public function findOneBySomeField($value): ?BricoleursPlatriers
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
