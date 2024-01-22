<?php

namespace App\Repository;

use App\Entity\Notificaciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Notificaciones>
 *
 * @method Notificaciones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notificaciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notificaciones[]    findAll()
 * @method Notificaciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificacionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notificaciones::class);
    }

//    /**
//     * @return Notificaciones[] Returns an array of Notificaciones objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Notificaciones
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
