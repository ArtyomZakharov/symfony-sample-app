<?php

namespace AppBundle\Response;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Formatter
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param array $items
     * @param int $totalItems
     * @param int $itemsPerPage
     * @param int $page
     * @param int $pages
     * @param string $routeName
     * @param array $routeParams
     * @return array
     */
    public function format(array $items, $totalItems, $itemsPerPage, $page, $pages, $routeName, $routeParams = [])
    {
        $meta = [
            'counters' => [
                'current_items' => 0
            ]
        ];

        if ($items) {
            $router = $this->router;

            $links = [
                'self' => $router->generate($routeName, array_merge($routeParams, ['page' => $page])),
                'first' => $router->generate($routeName, array_merge($routeParams, ['page' => 1])),
                'last' => $router->generate($routeName, array_merge($routeParams, ['page' => $pages]))
            ];

            if ($page != 1) {
                $links['previous'] = $router->generate($routeName, array_merge($routeParams, ['page' => $page - 1]));
            }

            if ($page != $pages) {
                $links['next'] = $router->generate($routeName, array_merge($routeParams, ['page' => $page + 1]));
            }

            $meta = [
                'counters' => [
                    'page' => $page,
                    'pages' => $pages,
                    'items_per_page' => $itemsPerPage,
                    'current_items' => count($items),
                    'total_items' => $totalItems
                ],
                'links' => $links
            ];
        }

        return [
            'meta' => $meta,
            'items' => $items
        ];
    }
}
