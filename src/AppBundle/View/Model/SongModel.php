<?php

namespace AppBundle\View\Model;

use AppBundle\View\Creator\SongCreator;

class SongModel extends AbstractModel
{
    // const CONTEXT_SONG = 'song';
    const CONTEXT_LIST = 'list';

    /**
     * {@inheritdoc}
     */
    public function toArray(string $context = null)
    {
        $entity = $this->entity;

        switch ($context) {
            case self::CONTEXT_LIST:
                $data = [
                    'id' => $entity->getId(),
                    'title' => $entity->getTitle(),
                    'artist' => (new ArtistModel($entity->getArtist()))
                        ->create(ArtistModel::CONTEXT_SONG),
                    'genre' => (new GenreModel($entity->getGenre()))
                        ->create(GenreModel::CONTEXT_SONG),
                    'year' => $entity->getReleaseDate()->format('Y')
                ];
                break;

            default:
                $data = [
                    'id' => $entity->getId(),
                    'name' => $entity->getName()
                ];

        }

        return $data;
    }
}
