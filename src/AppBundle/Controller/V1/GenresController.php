<?php

namespace AppBundle\Controller\V1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\{Route, Method};
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{Request, Response, JsonResponse};
use AppBundle\Entity\Genre;
use AppBundle\View\Model\GenreModel;

class GenresController extends Controller
{
    /**
     * @Route("/genres", name="api_v1_genres_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        return $this->get('app.genre_finder')->getAll($request, GenreModel::CONTEXT_LIST);
    }

    /**
     * @Route(
     *     "/genres/{id}",
     *     name="api_v1_genres_view",
     *     requirements={"id": "\d+"}
     * )
     * @Method("GET")
     */
    public function viewAction(int $id)
    {
        return $this->get('app.genre_finder')->getById($id)->asArray();
    }

    /**
     * @Route("/genres", name="api_v1_genres_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $genre = new Genre();

        $form = $this
            ->get('app.genre_form')
            ->setData($genre, $request)
            ->validate();

        if ($form->isValid()) {
            $this
                ->get('app.genre_service')
                ->save($genre);
            $response = new Response('', Response::HTTP_CREATED);
        } else {
            $response = new JsonResponse($form->getErrors(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route(
     *     "/genres/{id}",
     *     name="api_v1_genres_update",
     *     requirements={"id": "\d+"}
     * )
     * @Method("PATCH")
     */
    public function updateAction(Request $request, int $id)
    {
        $genre = $this->get('app.genre_finder')->getById($id)->asObject();

        $form = $this
            ->get('app.genre_form')
            ->setData($genre, $request)
            ->validate();

        if ($form->isValid()) {
            $this
                ->get('app.genre_service')
                ->save($genre);
            $response = new Response();
        } else {
            $response = new JsonResponse($form->getErrors(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route(
     *     "/genres/{id}",
     *     name="api_v1_genres_delete",
     *     requirements={"id": "\d+"}
     * )
     * @Method("DELETE")
     */
    public function deleteAction(int $id)
    {
        $genre = $this->get('app.genre_finder')->getById($id)->asObject();

        $this->get('app.genre_service')->delete($genre);
    }
}
