<?php

use Phpmig\Migration\Migration;

class CreateTableCities extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "CREATE TABLE `cities` (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(255), countyId INT, created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, modified DATETIME, `status` TINYINT) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DROP TABLE `cities`";
        $container = $this->getContainer(); 
        $container['db']->query($sql);
    }
}
