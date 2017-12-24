<?php

namespace AppBundle\Finder;

use AppBundle\Pagination\Exception\InvalidPageException;
use AppBundle\Pagination\Pagination;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Finder\Traits\{RouterTrait, ResponseFormatterTrait};
use AppBundle\Utils\DateTimeUtils;

class SongFinder extends AbstractFinder
{
    use RouterTrait, ResponseFormatterTrait;

    const SONGS_PER_PAGE = 10;

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

        $limit = $request->query->get('limit', self::SONGS_PER_PAGE);

        $songs = [];
        $pages = 0;

        $repo = $this->repository;

        $criteria = $this->getFilteringCriteria($request);

        $total = $repo->countAll($criteria);

        if ($total) {
            $pagination = new Pagination($page, $limit, $total);
            $pages = $pagination->calculatePages();

            $songs = $repo->getAll($criteria, $limit, $pagination->calculateOffset());
            $songs = $this->viewModelCreator->createFromArray($songs, $context);
        }

        return $this->responseFormatter->format($songs, $total, $limit, $page, $pages, 'api_v1_songs_index');
    }

    /**
     * @param int $id
     * @return self
     */
    public function getById(int $id): self
    {
        $song = $this->repository->find($id);

        if (!$song) {
            throw new NotFoundHttpException();
        }

        $this->entity = $song;

        return $this;
    }

    // TODO: find better way to get this
    private function getFilteringCriteria(Request $request): array
    {
        $criteria = [];

        $artistId = $request->query->get('artist_id');
        if ($artistId && $artistId !== 'null') {
            $criteria[] = [
                'match_type' => 'exact',
                'name' => 'artist',
                'value' => $artistId
            ];
        }

        $genreId = $request->query->get('genre_id');
        if ($artistId && $artistId !== 'null') {
            $criteria[] = [
                'match_type' => 'exact',
                'name' => 'genre',
                'value' => $genreId
            ];
        }

        $year = $request->query->get('year');
        if ($year && $year !== 'null') {
            $criteria[] = [
                'match_type' => 'between',
                'name' => 'releaseDate',
                'value' => [
                    'from' => DateTimeUtils::getYearBeginning($year),
                    'to' => DateTimeUtils::getYearEnd($year)
                ]
            ];
        }

        return $criteria;
    }
}
