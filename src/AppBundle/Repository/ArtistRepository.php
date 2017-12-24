<?php

namespace AppBundle\Repository;

class ArtistRepository extends \Doctrine\ORM\EntityRepository
{
    public function countAll(): int
    {
        return $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getAll(int $limit = null, int $offset = null): array
    {
        return $this->createQueryBuilder('a')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }
}
