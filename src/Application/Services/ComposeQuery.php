<?php

namespace Application\Services;

use Application\Services\DataBaseManagerService;
use Application\Services\InputDataValidation;

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
		$this->validation($this->requestBody);
		$this->databaseManager = new DataBaseManagerService();
	}
	
	private function validation($inputData)
	{
		if (isset($inputData)) {
			foreach ($inputData as $id => $data) {
				$this->requestBody->id = InputDataValidation::dataValidation($data);
			}
		}
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
		$params = [':countyId' => $this->requestBody->countyId];
		return json_encode($this->databaseManager->dbFetchQuerySafe('SELECT id, name FROM cities WHERE status = 1 AND countyId= :countyId',$params));
		// return json_encode($this->databaseManager->dbFetchQuery('SELECT id, name FROM cities WHERE status = 1 AND countyId='.$this->requestBody->countyId));
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
