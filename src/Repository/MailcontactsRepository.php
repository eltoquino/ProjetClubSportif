<?php

namespace App\Repository;

use App\Entity\Mailcontacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mailcontacts>
 *
 * @method Mailcontacts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mailcontacts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mailcontacts[]    findAll()
 * @method Mailcontacts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailcontactsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mailcontacts::class);
    }

    public function findMailSendContacts(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT me.id,me.date_envoi,me.objet,me.message,me.important
        FROM  mailcontacts me  
        WHERE me.id_educateurs= :id and me.supprimer=0 ORDER BY date_envoi desc
          ';

        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }


    public function findOneMailSendContacts(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT me.id,me.date_envoi,me.objet,me.message,me.important
        FROM  mailcontacts me  
        WHERE me.id= :id and me.supprimer=0 ORDER BY date_envoi desc
          ';

        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }




//    /**
//     * @return Mailcontacts[] Returns an array of Mailcontacts objects
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

//    public function findOneBySomeField($value): ?Mailcontacts
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
