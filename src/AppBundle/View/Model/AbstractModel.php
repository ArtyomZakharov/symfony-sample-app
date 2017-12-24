<?php

namespace AppBundle\View\Model;

use AppBundle\Entity\EntityInterface;

abstract class AbstractModel
{
    /**
     * @var EntityInterface
     */
    protected $entity;

    /**
     * @param EntityInterface $entity
     */
    public function __construct(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param string $context
     * @return array
     */
    abstract public function toArray(string $context = null);
}
