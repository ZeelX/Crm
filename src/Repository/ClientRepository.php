<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Secteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Client $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @return Client[]  sharing same activity sector
     */
    public function remove(Client $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    public function findWithSector(Secteur $secteurs)
    {

        $qb = $this->createQueryBuilder('client')
                ->innerJoin('client.secteur', 's')
                ->where('s.id IN (:data_ids)')
                ->setParameter('data_ids', $secteurs);
            return $qb->getQuery()
                ->getResult();
    }

    /**
      * @return Client[] Returns an array of Client objects from searched typed
      */


    public function findBySearchedField($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.nom = :val')
            ->orWhere('c.entreprise = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findContract($contrats)
    {

        $qb = $this->createQueryBuilder('client')
            ->innerJoin('client.contrat', 'co')
            ->where('co.id IN (:data_ids)')
            ->setParameter('data_ids', $contrats);
        return $qb->getQuery()
            ->getResult();
    }



}
