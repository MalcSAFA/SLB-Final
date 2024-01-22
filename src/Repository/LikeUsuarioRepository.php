<?php

namespace App\Repository;

use App\Entity\LikeUsuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LikeUsuario>
 *
 * @method LikeUsuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeUsuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeUsuario[]    findAll()
 * @method LikeUsuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeUsuarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikeUsuario::class);
    }

//    /**
//     * @return LikeUsuario[] Returns an array of LikeUsuario objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LikeUsuario
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
