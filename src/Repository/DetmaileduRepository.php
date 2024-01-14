<?php

namespace App\Repository;

use App\Entity\Detmailedu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Detmailedu>
 *
 * @method Detmailedu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detmailedu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detmailedu[]    findAll()
 * @method Detmailedu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetmaileduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detmailedu::class);
    }


    public function findBoiteReception(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT me.id,me.date_envoi,me.objet,me.message,det.id_educateurs,lc.nom,lc.prenom
        FROM detmailedu det join mailedu me on det.id_mailedu=me.id
        join licencies lc on det.id_educateurs=lc.id
        WHERE me.id= :id and det.supprimer=0
          ';

        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }







//    /**
//     * @return Detmailedu[] Returns an array of Detmailedu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Detmailedu
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
