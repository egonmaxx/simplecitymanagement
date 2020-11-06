<?php
namespace Application\RouteEndpoints;

use Application\Entities\RouteInterface;
use Application\Services\ComposeQuery;

/**
 * GetAllCounties - represent a county selection from db
 */
class GetAllCounties implements RouteInterface
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
     * @return string
     */
    public function response()
    {
        try {
            $respond = $this->composeQuery->getAllCounties();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }

        return $respond;

    }
}