<?php

namespace AppBundle\Finder;

use AppBundle\Pagination\Exception\InvalidPageException;
use AppBundle\Pagination\Pagination;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Finder\Traits\{RouterTrait, ResponseFormatterTrait};

class ArtistFinder extends AbstractFinder
{
    use RouterTrait, ResponseFormatterTrait;

    const ARTISTS_PER_PAGE = 10;

    /**
     * @param Request $request
     * @param string $context
     * @return array
     */
    public function getAll(Request $request, string $context = null): array
    {
        $page = $request->query->get('page');
        if ($page == 'null' || $page === null) {
            $page = 1;
        } elseif ($page < 1) {
            throw new InvalidPageException('Less than 1');
        }

        $limit = $request->query->get('limit', self::ARTISTS_PER_PAGE);

        $artists = [];
        $pages = 0;

        $repo = $this->repository;

        $total = $repo->countAll();

        if ($total) {
            $pagination = new Pagination($page, $limit, $total);
            $pages = $pagination->calculatePages();

            $artists = $repo->getAll($limit, $pagination->calculateOffset());
            $artists = $this->viewModelCreator->createFromArray($artists, $context);
        }

        return $this->responseFormatter->format($artists, $total, $limit, $page, $pages, 'api_v1_artists_index');
    }

    /**
     * @param int $id
     * @return self
     */
    public function getById(int $id): self
    {
        $artist = $this->repository->find($id);

        if (!$artist) {
            throw new NotFoundHttpException();
        }

        $this->entity = $artist;

        return $this;
    }
}
