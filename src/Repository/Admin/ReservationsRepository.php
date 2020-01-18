<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Reservations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Reservations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservations[]    findAll()
 * @method Reservations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservations::class);
    }

   public function getReservation(): array
   {
       $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT r.*, u.name as uname, t.title as ttype, s.title as stitle 
        FROM reservations r
        Join user u ON u.id = r.userid
        JOIN station s ON s.id = r.stationid
        JOIN transports t  ON t.id = r.transportsid";
   
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   

   return $stmt->fetchAll();
}
}
