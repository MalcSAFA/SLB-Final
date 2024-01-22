<?php

namespace App\Repository;

use App\Entity\Seguidores;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seguidores>
 *
 * @method Seguidores|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seguidores|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seguidores[]    findAll()
 * @method Seguidores[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeguidoresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seguidores::class);
    }

//    /**
//     * @return Seguidores[] Returns an array of Seguidores objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Seguidores
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
