<?php

namespace AppBundle\Pagination;

use AppBundle\Pagination\Exception\InvalidPageException;

class Pagination
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $totalItems;

    /**
     * @var int
     */
    private $pages;

    /**
     * @param int $page
     * @param int $limit
     * @param int $totalItems
     */
    public function __construct($page, $limit, $totalItems)
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->totalItems = $totalItems;

        if (!$this->isPageValid()) {
            throw new InvalidPageException('Out of range');
        }
    }

    /**
     * @return bool
     */
    public function isPageValid()
    {
        return $this->page <= $this->calculatePages();
    }

    /**
     * @return int
     */
    public function calculatePages()
    {
        if (!$this->pages) {
            $this->pages = ceil($this->totalItems / $this->limit);
        }

        return $this->pages;
    }

    /**
     * @return int
     */
    public function calculateOffset()
    {
        return ($this->page - 1) * $this->limit;
    }
}
