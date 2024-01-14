<?php

namespace App\Repository;

use App\Entity\Mailedu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mailedu>
 *
 * @method Mailedu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mailedu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mailedu[]    findAll()
 * @method Mailedu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaileduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mailedu::class);
    }

    public function findMailSend(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT me.id,me.date_envoi,me.objet,me.message,me.important
        FROM  mailedu me  
        WHERE me.id_educateurs= :id and me.supprimer=0 ORDER BY date_envoi desc
          ';

        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }



    public function findOneMailSend(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT me.id,me.date_envoi,me.objet,me.message,me.important
        FROM  mailedu me  
        WHERE me.id= :id and me.supprimer=0 ORDER BY date_envoi desc
          ';

        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }







//    /**
//     * @return Mailedu[] Returns an array of Mailedu objects
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

//    public function findOneBySomeField($value): ?Mailedu
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
