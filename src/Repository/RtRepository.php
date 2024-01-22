<?php

namespace App\Repository;

use App\Entity\Rt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rt>
 *
 * @method Rt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rt[]    findAll()
 * @method Rt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rt::class);
    }

//    /**
//     * @return Rt[] Returns an array of Rt objects
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

//    public function findOneBySomeField($value): ?Rt
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
