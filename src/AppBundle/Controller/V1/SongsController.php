<?php

namespace AppBundle\Controller\V1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\{Route, Method};
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{Request, Response, JsonResponse};
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use AppBundle\Entity\{Song, Artist, Genre};
use AppBundle\View\Model\SongModel;

class SongsController extends Controller
{
    /**
     * @Route("/songs", name="api_v1_songs_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        return $this->get('app.song_finder')->getAll($request, SongModel::CONTEXT_LIST);
    }

    /**
     * @Route(
     *     "/songs/{id}",
     *     name="api_v1_songs_view",
     *     requirements={"id": "\d+"}
     * )
     * @Method("GET")
     */
    public function viewAction(int $id)
    {
        return $this->get('app.song_finder')->getById($id)->asArray();
    }

    /**
     * @Route("/songs", name="api_v1_songs_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $song = (new Song())
            ->setArtist($this->getArtist($request))
            ->setGenre($this->getGenre($request));

        $form = $this
            ->get('app.song_form')
            ->setData($song, $request)
            ->validate();

        if ($form->isValid()) {
            $this
                ->get('app.song_service')
                ->save($song);
            $response = new Response('', Response::HTTP_CREATED);
        } else {
            $response = new JsonResponse($form->getErrors(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route(
     *     "/songs/{id}",
     *     name="api_v1_songs_update",
     *     requirements={"id": "\d+"}
     * )
     * @Method("PATCH")
     */
    public function updateAction(Request $request, int $id)
    {
        $song = $this->get('app.song_finder')->getById($id)->asObject();

        $form = $this
            ->get('app.song_form')
            ->setData($song, $request)
            ->validate();

        if ($form->isValid()) {
            $this
                ->get('app.song_service')
                ->save($song);
            $response = new Response();
        } else {
            $response = new JsonResponse($form->getErrors(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route(
     *     "/songs/{id}",
     *     name="api_v1_songs_delete",
     *     requirements={"id": "\d+"}
     * )
     * @Method("DELETE")
     */
    public function deleteAction(int $id)
    {
        $song = $this->get('app.song_finder')->getById($id)->asObject();

        $this->get('app.song_service')->delete($song);
    }

    private function getArtist(Request $request): Artist
    {
        $artistId = (int) $request->get('artist_id');
        if (!$artistId) {
            throw new BadRequestHttpException('artist_id is required');
        }

        $artist = $this->get('app.artist_repository')->find($artistId);
        if (!$artist) {
            throw new BadRequestHttpException('Artist with such ID not found');
        }

        return $artist;
    }

    private function getGenre(Request $request): Genre
    {
        $genreId = (int) $request->get('genre_id');
        if (!$genreId) {
            throw new BadRequestHttpException('genre_id is required');
        }

        $genre = $this->get('app.artist_repository')->find($genreId);
        if (!$genre) {
            throw new BadRequestHttpException('Genre with such ID not found');
        }

        return $genre;
    }
}
