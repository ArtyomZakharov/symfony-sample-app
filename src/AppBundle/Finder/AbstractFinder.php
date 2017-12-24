<?php

namespace AppBundle\Finder;

use Doctrine\ORM\EntityRepository;
use AppBundle\View\Creator\AbstractCreator;

abstract class AbstractFinder
{
    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var AbstractCreator
     */
    protected $viewModelCreator;

    /**
     * @var \AppBundle\Entity\EntityInterface
     */
    protected $entity;

    /**
     * @param EntityRepository $repository
     * @param AbstractCreator $viewModelCreator
     */
    public function __construct(EntityRepository $repository, AbstractCreator $viewModelCreator = null)
    {
        $this->repository = $repository;
        $this->viewModelCreator = $viewModelCreator;
    }

    /**
     * @return \AppBundle\Entity\EntityInterface
     */
    public function asObject()
    {
        return $this->entity;
    }

    /**
     * @param string $context
     * @return array
     */
    public function asArray($context = null)
    {
        return $this->viewModelCreator->create($this->entity, $context);
    }
}
