<?php

namespace App\Repository;

use App\Entity\Licencies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Licencies>
 *
 * @method Licencies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Licencies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Licencies[]    findAll()
 * @method Licencies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LicenciesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Licencies::class);
    }


    public function findAllLicencieCategorie(string $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT l.numero_licence,l.nom,l.prenom,p.code codecateg,p.nom nomcateg,
            ct.nom nomcontact,ct.prenom prenomcontact,ct.email emailcontact,ct.numero_tel telcontact
             FROM categories p join licencies l on p.id=l.categorie_id
             join contacts ct on l.contact_id=ct.id 
            WHERE p.id = :id
           
            ';

        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }


    

//    /**
//     * @return Licencies[] Returns an array of Licencies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Licencies
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
