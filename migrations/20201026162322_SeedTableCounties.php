<?php

use Phpmig\Migration\Migration;

class SeedTableCounties extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "INSERT INTO `counties` (name) VALUES ('Békés'),('Baranya'),('Bács-KisKun')";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "TRUNCATE TABLE `counties`";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
