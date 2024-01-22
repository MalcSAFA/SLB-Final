<?php

namespace App\Repository;

use App\Entity\RtUsuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RtUsuario>
 *
 * @method RtUsuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method RtUsuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method RtUsuario[]    findAll()
 * @method RtUsuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RtUsuarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RtUsuario::class);
    }

//    /**
//     * @return RtUsuario[] Returns an array of RtUsuario objects
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

//    public function findOneBySomeField($value): ?RtUsuario
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
