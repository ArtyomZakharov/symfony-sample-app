<?php

namespace AppBundle\View\Creator;

use AppBundle\Entity\EntityInterface;
use AppBundle\View\Model\ArtistModel;

class ArtistCreator extends AbstractCreator
{
    /**
     * {@inheritdoc}
     */
    public function create(EntityInterface $artist, $context = null)
    {
        return (new ArtistModel($artist))->toArray($context);
    }
}
