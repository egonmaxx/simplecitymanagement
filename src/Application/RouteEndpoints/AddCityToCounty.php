<?php
namespace Application\RouteEndpoints;

use Application\Entities\RouteInterface;
use Application\Services\ComposeQuery;

/**
 * AddCityToCounty - represent a city insertion into database
 */
class AddCityToCounty implements RouteInterface
{    
    /**
     * composeQuery
     *
     * @var mixed
     */
    private $composeQuery;
    
    /**
     * __construct
     *
     * @param  mixed $request
     * @return void
     */
    public function __construct($request)
	{
        $this->composeQuery = new ComposeQuery($request);
    }
        
    /**
     * response - returns content data
     *
     * @return string
     */
    public function response()
    {
        try {
            $this->composeQuery->addCityByCountyId();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }

        return json_encode(['success' => true]);

    }
}