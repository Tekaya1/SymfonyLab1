<?php

namespace App\Repository;

use App\Entity\Modele;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Modele>
 */
class ModeleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modele::class);
    }

    //    /**
    //     * @return Modele[] Returns an array of Modele objects
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

    //    public function findOneBySomeField($value): ?Modele
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


    public function addModele(string $libelle, string $pays): Modele
    {
        $entityManager = $this->getEntityManager();

        $modele = new Modele();
        $modele->setLibelle($libelle);
        $modele->setPays($pays);

        $entityManager->persist($modele);
        $entityManager->flush();

        return $modele;
    }

    public function findallModele(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\Modele m
            ORDER BY m.libelle ASC'
        );
        return $query->getResult();
    }

    public function updateModele(int $id, string $Libelle, string $Pays): ?Modele
    {
        $entityManager = $this->getEntityManager();
        $query= $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\Modele m
            WHERE m.id = :id'
        )
        ->setParameter('id', $id)
        ->setParameter('libelle', $Libelle)
        ->setParameter('pays', $Pays);
        $entityManager->flush();

        return $query->execute();
    }
    public function deleteModele(int $id): int
    {
        $entityManager = $this->getEntityManager();
        $query= $entityManager->createQuery(
            'DELETE FROM App\Entity\Modele m
            WHERE m.id = :id'
        )
        ->setParameter('id', $id);
        return $query->execute();
    }
}

