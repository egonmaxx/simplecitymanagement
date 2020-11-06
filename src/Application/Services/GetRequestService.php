<?php

namespace Application\Services;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\ServerRequest;

/**
 * GetRequestService - represent the incoming http request
 */
class GetRequestService
{    
    /**
     * getRequest
     *
     * @return Request
     */
    public static function getRequest()
    {
        $request = ServerRequest::fromGlobals();
        return new Request($request->getMethod(),$request->getUri(),$request->getHeaders(),(string)$request->getBody(),$request->getProtocolVersion());
    }
}