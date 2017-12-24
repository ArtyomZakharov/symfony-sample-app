<?php

namespace AppBundle\Service;

use AppBundle\Entity\Artist;
use AppBundle\Service\Traits\EntityManagerTrait;

class ArtistService
{
    use EntityManagerTrait;

    /**
     * @param Artist $artist
     * @return boid
     */
    public function save(Artist $artist)
    {
        $this->entityManager->persist($artist);
        $this->entityManager->flush();
    }

    /**
     * @param Artist $artist
     * @return void
     */
    public function delete(Artist $artist)
    {
        $this->entityManager->remove($artist);
        $this->entityManager->flush();
    }
}
