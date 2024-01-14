<?php

namespace App\Repository;

use App\Entity\Detmailcontacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Detmailcontacts>
 *
 * @method Detmailcontacts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detmailcontacts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detmailcontacts[]    findAll()
 * @method Detmailcontacts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetmailcontactsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detmailcontacts::class);
    }

   
    public function findBoiteReception(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT  me.id,me.date_envoi,me.objet,me.message,det.id_contacts,ct.nom,ct.prenom
        FROM detmailcontacts det join mailcontacts me on det.id_mailcontact=me.id
        join contacts ct on det.id_contacts=ct.id
        WHERE me.id= :id and det.supprimer=0
          ';

        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }





//    /**
//     * @return Detmailcontacts[] Returns an array of Detmailcontacts objects
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

//    public function findOneBySomeField($value): ?Detmailcontacts
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
