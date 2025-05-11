<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    
    public function searchClients(
        ?string $cni = null,
        ?string $nom = null,
        ?\DateTimeInterface $dateMin = null,
        ?\DateTimeInterface $dateMax = null
    ): array {
        $qb = $this->createQueryBuilder('c');
    
        if ($cni) {
            $qb->andWhere('c.cni LIKE :cni')
               ->setParameter('cni', '%'.$cni.'%');
        }
    
        if ($nom) {
            $qb->andWhere('c.nom LIKE :nom')
               ->setParameter('nom', '%'.$nom.'%');
        }
    
        if ($dateMin && $dateMax) {
            $qb->andWhere('c.dateNaissance BETWEEN :dateMin AND :dateMax')
               ->setParameter('dateMin', $dateMin)
               ->setParameter('dateMax', $dateMax);
        } elseif ($dateMin) {
            $qb->andWhere('c.dateNaissance >= :dateMin')
               ->setParameter('dateMin', $dateMin);
        } elseif ($dateMax) {
            $qb->andWhere('c.dateNaissance <= :dateMax')
               ->setParameter('dateMax', $dateMax);
        }
    
        return $qb->getQuery()->getResult();
    }



    

//    /**
//     * @return Client[] Returns an array of Client objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Client
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
