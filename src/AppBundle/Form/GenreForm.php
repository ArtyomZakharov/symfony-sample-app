<?php

namespace AppBundle\Form;

use AppBundle\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;

class GenreForm extends AbstractForm
{
    /**
     * {@inheritdoc}
     */
    public function setData(EntityInterface $entity, Request $request)
    {
        $this->entity = $entity
            ->setTitle($request->get('title', $entity->getTitle()));

        return $this;
    }
}
