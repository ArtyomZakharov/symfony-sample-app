<?php

namespace AppBundle\Controller\V1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\{Route, Method};
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{Request, Response, JsonResponse};
use AppBundle\Entity\Artist;
use AppBundle\View\Model\ArtistModel;

class ArtistsController extends Controller
{
    /**
     * @Route("/artists", name="api_v1_artists_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        return $this->get('app.artist_finder')->getAll($request, ArtistModel::CONTEXT_LIST);
    }

    /**
     * @Route(
     *     "/artists/{id}",
     *     name="api_v1_artists_view",
     *     requirements={"id": "\d+"}
     * )
     * @Method("GET")
     */
    public function viewAction(int $id)
    {
        return $this->get('app.artist_finder')->getById($id)->asArray();
    }

    /**
     * @Route("/artists", name="api_v1_artists_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $artist = new Artist();

        $form = $this
            ->get('app.artist_form')
            ->setData($artist, $request)
            ->validate();

        if ($form->isValid()) {
            $this
                ->get('app.artist_service')
                ->save($artist);
            $response = new Response('', Response::HTTP_CREATED);
        } else {
            $response = new JsonResponse($form->getErrors(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route(
     *     "/artists/{id}",
     *     name="api_v1_artists_update",
     *     requirements={"id": "\d+"}
     * )
     * @Method("PATCH")
     */
    public function updateAction(Request $request, int $id)
    {
        $artist = $this->get('app.artist_finder')->getById($id)->asObject();

        $form = $this
            ->get('app.artist_form')
            ->setData($artist, $request)
            ->validate();

        if ($form->isValid()) {
            $this
                ->get('app.artist_service')
                ->save($artist);
            $response = new Response();
        } else {
            $response = new JsonResponse($form->getErrors(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route(
     *     "/artists/{id}",
     *     name="api_v1_artists_delete",
     *     requirements={"id": "\d+"}
     * )
     * @Method("DELETE")
     */
    public function deleteAction(int $id)
    {
        $artist = $this->get('app.artist_finder')->getById($id)->asObject();

        $this->get('app.artist_service')->delete($artist);
    }
}
