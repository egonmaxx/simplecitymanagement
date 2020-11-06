<?php

namespace Application\Services;

use Application\Services\DataBaseManagerService;

/**
 * ComposeQuery - represent the db queries for the application
 */
class ComposeQuery {
	
	/**
	 * databaseManager
	 *
	 * @var mixed
	 */
	private $databaseManager;
	
	/**
	 * __construct
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function __construct($request)
	{
		$this->requestBody = json_decode($request->getBody()->getContents());
		$this->databaseManager = new DataBaseManagerService();
	}
	
	/**
	 * getAllCounties - selecting county query
	 *
	 * @return string
	 */
	public function getAllCounties()
	{
		
		return json_encode($this->databaseManager->dbFetchQuery('SELECT id, name FROM counties'));
	}
	
	/**
	 * addCityByCountyId - adding city query
	 *
	 * @return void
	 */
	public function addCityByCountyId()
	{
		$this->databaseManager->dbQuery('INSERT INTO cities (name,countyId,modified,status) VALUES (\''.$this->requestBody->name.'\','.$this->requestBody->countyId.',curdate(),1)');
	}
	
	/**
	 * getAllCitiesByCountyId - selecting city query
	 *
	 * @return string
	 */
	public function getAllCitiesByCountyId()
	{
		return json_encode($this->databaseManager->dbFetchQuery('SELECT id, name FROM cities WHERE countyId='.$this->requestBody->countyId.' AND status = 1'));
	}
	
	/**
	 * deleteCityById - deleteing city query
	 *
	 * @return void
	 */
	public function deleteCityById()
	{
		$this->databaseManager->dbQuery('UPDATE cities SET status = 0 WHERE id='.$this->requestBody->cityId);
	}
	
	/**
	 * updateCityNameById - updating city name query
	 *
	 * @return string
	 */
	public function updateCityNameById()
	{
		$this->databaseManager->dbQuery('UPDATE cities SET name = \''.$this->requestBody->name.'\', modified = curdate() WHERE id='.$this->requestBody->cityId);
	}
}
