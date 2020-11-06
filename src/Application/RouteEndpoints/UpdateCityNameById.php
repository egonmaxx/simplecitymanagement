<?php
namespace Application\RouteEndpoints;

use Application\Entities\RouteInterface;
use Application\Services\ComposeQuery;

/**
 * UpdateCityNameById - represent a city name update in database
 */
class UpdateCityNameById implements RouteInterface
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
            $this->composeQuery->updateCityNameById();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }

        return json_encode(['success' => true]);

    }
}