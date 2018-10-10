<?php

namespace App\Repository;

use App\Entity\Material1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Material1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Material1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Material1[]    findAll()
 * @method Material1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Material1Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Material1::class);
    }

//    /**
//     * @return Material1[] Returns an array of Material1 objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Material1
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
