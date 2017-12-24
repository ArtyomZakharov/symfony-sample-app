<?php

namespace AppBundle\Finder\Traits;

use AppBundle\Response\Formatter as ResponseFormatter;

trait ResponseFormatterTrait
{
    /**
     * @var ResponseFormatter
     */
    private $responseFormatter;

    /**
     * @param ResponseFormatter $responseFormatter
     * @return self
     */
    public function setResponseFormatter(ResponseFormatter $responseFormatter)
    {
        $this->responseFormatter = $responseFormatter;

        return $this;
    }
}
