<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }
    public function getAllEvents()
    {
        return $this->createQueryBuilder('e') // 'e' is an alias for 'Event'
            ->getQuery() // Convert the query builder instance into a Query object
            ->getResult(); // Execute the query and get the results
    }

    public function getEventByActivity($activity)
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.activities', 'a')
            ->andWhere('a.id = :activity')
            ->setParameter('activity', $activity)
            ->getQuery()
            ->getResult();
    }

    public function getEventOrderByStartDate()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.startdate', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
