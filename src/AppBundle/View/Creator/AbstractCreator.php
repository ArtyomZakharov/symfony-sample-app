<?php

namespace AppBundle\View\Creator;

use AppBundle\Entity\EntityInterface;

abstract class AbstractCreator
{
    /**
     * @param EntityInterface $entity
     * @param string $context
     * @return array
     */
    abstract public function create(EntityInterface $entity, $context = null);

    /**
     * @param array $entities
     * @param string $context
     * @return array
     */
    public function createFromArray(array $entities, $context = null)
    {
        $viewModels = [];
        foreach ($entities as $entity) {
            $viewModels[] = $this->create($entity, $context);
        }

        return $viewModels;
    }
}
