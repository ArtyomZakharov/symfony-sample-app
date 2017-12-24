<?php

namespace AppBundle\Repository;

class SongRepository extends \Doctrine\ORM\EntityRepository
{
    public function countAll()
    {
        return $this->createQueryBuilder('s')
            ->select('count(s.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getAll(int $limit = null, int $offset = null): array
    {
        return $this->createQueryBuilder('s')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function getByArtist(Artist $artist, int $limit = null, int $offset = null): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.artist = :artist')
            ->setParameter('artist', $artist)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('c.publicationDate', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
