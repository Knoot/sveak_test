<?php

namespace App\Repository;

use App\Entity\EmailDomain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmailDomain>
 *
 * @method EmailDomain|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmailDomain|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmailDomain[]    findAll()
 * @method EmailDomain[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailDomainRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailDomain::class);
    }
}
