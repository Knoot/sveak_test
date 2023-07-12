<?php

namespace App\Repository;

use App\Entity\MobileOperator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MobileOperator>
 *
 * @method MobileOperator|null find($id, $lockMode = null, $lockVersion = null)
 * @method MobileOperator|null findOneBy(array $criteria, array $orderBy = null)
 * @method MobileOperator[]    findAll()
 * @method MobileOperator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobileOperatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MobileOperator::class);
    }

//    /**
//     * @return MobileOperator[] Returns an array of MobileOperator objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MobileOperator
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
