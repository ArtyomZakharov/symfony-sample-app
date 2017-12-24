<?php

namespace AppBundle\View\Creator;

use AppBundle\Entity\EntityInterface;
use AppBundle\View\Model\GenreModel;

class GenreCreator extends AbstractCreator
{
    /**
     * {@inheritdoc}
     */
    public function create(EntityInterface $genre, $context = null)
    {
        return (new GenreModel($genre))->toArray($context);
    }
}
