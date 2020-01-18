<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Transports;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Transports|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transports|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transports[]    findAll()
 * @method Transports[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transports::class);
    }

    // /**
    //  * @return Transports[] Returns an array of Transports objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Transports
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getTransport(): array
    {
        $conn = $this->getEntityManager()->getConnection();
         $sql = "SELECT t.*, s.title as stitle 
         FROM transports t
         JOIN station s ON s.id = t.stationid";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
 
    return $stmt->fetchAll();
 }
}
