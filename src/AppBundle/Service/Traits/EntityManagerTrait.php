<?php

namespace AppBundle\Service\Traits;

use Doctrine\ORM\EntityManager;

trait EntityManagerTrait
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function setEntityManager(EntityManager $entityManager): self
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
