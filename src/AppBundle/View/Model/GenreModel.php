<?php

namespace AppBundle\View\Model;

use AppBundle\View\Creator\SongCreator;

class GenreModel extends AbstractModel
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
                    'title' => $entity->getTitle()
                ];
                break;

            case self::CONTEXT_LIST:
                $data = [
                    'id' => $entity->getId(),
                    'title' => $entity->getTitle()
                ];
                break;

            default:
                $data = [
                    'id' => $entity->getId(),
                    'title' => $entity->getTitle(),
                    'songs' => (new SongCreator())
                        ->createFromArray($entity->getSongs())
                ];
        }

        return $data;
    }
}
