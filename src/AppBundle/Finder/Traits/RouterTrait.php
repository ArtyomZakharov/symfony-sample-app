<?php

namespace AppBundle\Finder\Traits;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

trait RouterTrait
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router $router
     * @return self
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;

        return $this;
    }
}
