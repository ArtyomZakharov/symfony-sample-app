<?php

namespace AppBundle\Repository;

class GenreRepository extends \Doctrine\ORM\EntityRepository
{
    public function countAll(): int
    {
        return $this->createQueryBuilder('g')
            ->select('count(g.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getAll(int $limit = null, int $offset = null): array
    {
        return $this->createQueryBuilder('g')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }
}
