<?php

namespace Application\RouteEndpoints;

use Application\Entities\RouteInterface;

class HttpNotFound implements RouteInterface
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
        http_response_code(404);
        return file_get_contents(__DIR__.'/../../../public/files/404.html');
    }
}