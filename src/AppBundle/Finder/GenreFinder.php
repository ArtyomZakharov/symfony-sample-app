<?php

namespace AppBundle\Finder;

use AppBundle\Pagination\Exception\InvalidPageException;
use AppBundle\Pagination\Pagination;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Finder\Traits\{RouterTrait, ResponseFormatterTrait};

class GenreFinder extends AbstractFinder
{
    use RouterTrait, ResponseFormatterTrait;

    const GENRES_PER_PAGE = 10;

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

        $limit = $request->query->get('limit', self::GENRES_PER_PAGE);

        $genres = [];
        $pages = 0;

        $repo = $this->repository;

        $total = $repo->countAll();

        if ($total) {
            $pagination = new Pagination($page, $limit, $total);
            $pages = $pagination->calculatePages();

            $genres = $repo->getAll($limit, $pagination->calculateOffset());
            $genres = $this->viewModelCreator->createFromArray($genres, $context);
        }

        return $this->responseFormatter->format($genres, $total, $limit, $page, $pages, 'api_v1_genres_index');
    }

    /**
     * @param int $id
     * @return self
     */
    public function getById(int $id): self
    {
        $genre = $this->repository->find($id);

        if (!$genre) {
            throw new NotFoundHttpException();
        }

        $this->entity = $genre;

        return $this;
    }
}
