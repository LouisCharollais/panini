<?php

namespace App\Repository;

use App\Entity\Paninis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Paninis>
 *
 * @method Paninis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paninis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paninis[]    findAll()
 * @method Paninis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaninisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paninis::class);
    }

//    /**
//     * @return Paninis[] Returns an array of Paninis objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Paninis
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
