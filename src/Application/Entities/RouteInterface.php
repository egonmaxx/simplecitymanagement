<?php

namespace Application\Entities;

/**
 * RouteInterface - represent requirements for RouteEndpoint classes
 */

interface RouteInterface
{    
    /**
     * response - this function returns the content data
     *
     * @return void
     */
    public function response();
}