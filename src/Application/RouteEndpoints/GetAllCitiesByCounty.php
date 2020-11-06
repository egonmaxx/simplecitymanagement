<?php
namespace Application\RouteEndpoints;

use Application\Entities\RouteInterface;
use Application\Services\ComposeQuery;

/**
 * GetAllCitiesByCounty - represent a city list selection from db
 */
class GetAllCitiesByCounty implements RouteInterface
{    
    /**
     * composeQuery
     *
     * @var mixed
     */
    private $composeQuery;

    public function __construct($request)
	{
        $this->composeQuery = new ComposeQuery($request);
    }
        
    /**
     * response - returns content data
     *
     * @return void
     */
    public function response()
    {
        try {
            $respond = $this->composeQuery->getAllCitiesByCountyId();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }

        return $respond;

    }
}