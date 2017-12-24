<?php

namespace AppBundle\View\Model;

use AppBundle\View\Creator\SongCreator;

class ArtistModel extends AbstractModel
{
    const CONTEXT_SONG = 'song';
    const CONTEXT_LIST = 'list';

    /**
     * {@inheritdoc}
     */
    public function toArray(string $context = null)
    {
        $entity = $this->entity;

        switch ($context) {
            case self::CONTEXT_SONG:
                $data = [
                    'name' => $entity->getName()
                ];
                break;

            case self::CONTEXT_LIST:
                $data = [
                    'id' => $entity->getId(),
                    'name' => $entity->getName()
                ];
                break;

            default:
                $data = [
                    'id' => $entity->getId(),
                    'name' => $entity->getName(),
                    'songs' => (new SongCreator())
                        ->createFromArray($entity->getSongs())
                ];
        }

        return $data;
    }
}
