<?php

namespace AppBundle\Repository;

class SongRepository extends \Doctrine\ORM\EntityRepository
{
    public function countAll(string $criteria = []): int
    {
        list($where, $params) = $this->getWhereAndParams($criteria);

        return $this->createQueryBuilder('s')
            ->select('count(s.id)')
            ->where($where)
            ->setParameters($params)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getAll(array $criteria = [], int $limit = null, int $offset = null): array
    {
        list($where, $params) = $this->getWhereAndParams($criteria);

        return $this->createQueryBuilder('s')
            ->where($where)
            ->setParameters($params)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function getWhereAndParams(array $criteria): array
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
