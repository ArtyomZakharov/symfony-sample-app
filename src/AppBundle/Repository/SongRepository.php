<?php

namespace AppBundle\Repository;

use Doctrine\ORM\{EntityRepository, QueryBuilder};

class SongRepository extends EntityRepository
{
    public function countAll(string $criteria = []): int
    {
        $qb = $this->createQueryBuilder('s')->select('count(s.id)');

        list($where, $params) = $this->getWhereAndParams($criteria);
        if ($where && $params) {
            $qb->where($where)->setParameters($params);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getAll(array $filterBy = [], array $orderBy = [],
        int $limit = null, int $offset = null): array
    {
        $qb = $this->createQueryBuilder('s');

        list($where, $params) = $this->getWhereAndParams($filterBy);
        if ($where && $params) {
            $qb->where($where)->setParameters($params);
        }

        return $this->applyOrdering($qb, $orderBy)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function applyOrdering(QueryBuilder $qb, array $orderBy): QueryBuilder
    {
        switch ($orderBy['field']) {
            case 'artist':
                $qb->join('s.artist', 'a', 'a.id = s.artist');
                $field = 'a.name';
                break;

            case 'genre':
                $qb->join('s.genre', 'g', 'g.id = s.genre');
                $field = 'g.title';
                break;

            case 'year':
                $field = 's.releaseDate';
                break;

            case 'title':
                $field = 's.title';
                break;

            default:
                $field = 's.id';
        }

        return $qb->orderBy($field, $orderBy['direction'] ?: 'ASC');
    }

    private function getWhereAndParams(array $criteria): array
    {
        // TODO: get rid of this horrible part
        $conditions = [];
        $params = [];
        foreach ($criteria as $field) {
            $name = $field['name'];
            switch ($field['match_type']) {
                case 'exact':
                    $conditions[] = "s.$name = :$name";
                    $params[] = [$name => $field['value']];
                    break;

                case 'between':
                    $from = "from_$name";
                    $to = "to_$name";
                    $conditions[] = "(s.$name >= :$from and s.$name <= :$to)";
                    $params[] = [$from => $field['value']['from']];
                    $params[] = [$to => $field['value']['to']];
                    break;

                default:
                    break;
            }
        }
        $where = implode(' and ', $conditions);

        return [$where, $params];
    }
}
