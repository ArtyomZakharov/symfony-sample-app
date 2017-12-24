<?php

namespace AppBundle\View\Creator;

use AppBundle\Entity\EntityInterface;
use AppBundle\View\Model\SongModel;

class SongCreator extends AbstractCreator
{
    /**
     * {@inheritdoc}
     */
    public function create(EntityInterface $song, $context = null)
    {
        return (new SongModel($song))->toArray($context);
    }
}
