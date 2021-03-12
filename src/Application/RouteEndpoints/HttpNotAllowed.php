<?php

namespace Application\RouteEndpoints;

use Application\Entities\RouteInterface;

class HttpNotAllowed implements RouteInterface
{
    public function __construct($request)
    {
        
    }
    /**
     * response - returns the content data
     *
     * @return string
     */
    public function response()
    {
        http_response_code(405);
        return file_get_contents(__DIR__.'/../../../public/files/405.html');
    }
}