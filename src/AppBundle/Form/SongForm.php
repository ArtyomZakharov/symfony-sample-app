<?php

namespace AppBundle\Form;

use AppBundle\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;

class SongForm extends AbstractForm
{
    /**
     * {@inheritdoc}
     */
    public function setData(EntityInterface $entity, Request $request)
    {
        $this->entity = $entity
            ->setTitle($request->get('title', $entity->getTitle()))
            ->setReleaseDate($request->get('release_date', $entity->getReleaseDate()));

        return $this;
    }
}
