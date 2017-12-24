<?php

namespace AppBundle\Service;

use AppBundle\Entity\Genre;
use AppBundle\Service\Traits\EntityManagerTrait;

class GenreService
{
    use EntityManagerTrait;

    /**
     * @param Genre $genre
     * @return void
     */
    public function save(Genre $genre)
    {
        $this->entityManager->persist($genre);
        $this->entityManager->flush();
    }

    /**
     * @param Genre $genre
     * @return void
     */
    public function delete(Genre $genre)
    {
        $this->entityManager->remove($genre);
        $this->entityManager->flush();
    }
}
