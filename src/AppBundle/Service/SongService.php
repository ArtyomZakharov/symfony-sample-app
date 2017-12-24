<?php

namespace AppBundle\Service;

use AppBundle\Entity\Song;
use AppBundle\Service\Traits\EntityManagerTrait;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SongService
{
    use EntityManagerTrait;

    /**
     * @param Song $song
     * @return Song
     */
    public function save(Song $song)
    {
        if (is_string($song->getExpirationDate())) {
            $releaseDate = \DateTime::createFromFormat(
                \DateTime::ISO8601,
                $song->getExpirationDate()
            );
            if (!$releaseDate) {
                throw new BadRequestHttpException('Release date should be represented in ISO8601 format');
            }
            $song->setExpirationDate($releaseDate);
        }

        $this->entityManager->persist($song);
        $this->entityManager->flush();

        return $song;
    }

    /**
     * @param Song $song
     * @return void
     */
    public function delete(Song $song)
    {
        $this->entityManager->remove($song);
        $this->entityManager->flush();
    }
}
