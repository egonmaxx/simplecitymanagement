<?php

namespace Application\Services;

use PDO;

/**
 * DataBaseManagerService - represent the database layer
 */
class DataBaseManagerService
{    
    /**
     * dataBase
     *
     * @var mixed
     */
    private $dataBase;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $host = getenv('DATABASE_HOST');
        $db   = getenv('DATABASE_NAME');
        $user = getenv('DATABASE_USER');
        $pass = getenv('DATABASE_PASSWORD');
        $charset = getenv('DATABASE_CHARSET');

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->dataBase = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            echo $e->getMessage(), (int)$e->getCode();
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    
    /**
     * dbFetchQuery - pushing data into db
     *
     * @param  mixed $query
     * @return void
     */
    public function dbFetchQuery($query)
    {
        return $this->dataBase->query($query)->fetchAll();
    }
    
    /**
     * dbFetchQuerySafe - getting data from db
     * 
     * - preparing statement
     * - binding parameters and executing statement
     * - retuning with fetched data 
     *
     * @param  mixed $query
     * @param  mixed $params
     * @return void
     */
    public function dbFetchQuerySafe($query,$params)
    {
        $statement = $this->dataBase->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll();
    }
    
    /**
     * dbQuery - fetching data from db
     *
     * @param  mixed $query
     * @return void
     */
    public function dbQuery($query)
    {
        return $this->dataBase->prepare($query)->execute();
    }
    
    /**
     * dbQuerySafe
     *
     * @param  mixed $query
     * @param  mixed $params
     * @return void
     */
    public function dbQuerySafe($query,$params)
    {
        $statement = $this->dataBase->prepare($query);
        return $statement->execute($params);
    }
}
