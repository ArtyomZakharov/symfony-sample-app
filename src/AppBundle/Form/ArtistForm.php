<?php

namespace AppBundle\Form;

use AppBundle\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;

class ArtistForm extends AbstractForm
{
    /**
     * {@inheritdoc}
     */
    public function setData(EntityInterface $entity, Request $request)
    {
        $this->entity = $entity
            ->setName($request->get('name', $entity->getName()));

        return $this;
    }
}
