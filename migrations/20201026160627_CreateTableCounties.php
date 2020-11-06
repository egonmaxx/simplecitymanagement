<?php

use Phpmig\Migration\Migration;

class CreateTableCounties extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "CREATE TABLE counties (
            id INTEGER NOT NULL AUTO_INCREMENT,
            name TEXT NOT NULL,
            deleted_at TIMESTAMP,
            PRIMARY KEY(id)
            ) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DROP TABLE `counties`";
        $container = $this->getContainer(); 
        $container['db']->query($sql);
    }
}
