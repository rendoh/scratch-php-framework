<?php

use Phpmig\Migration\Migration;

class User extends Migration
{
    /**
     * Do the migration.
     */
    public function up()
    {
        $sql = '
        CREATE TABLE users (
            id INTEGER AUTO_INCREMENT,
            username VARCHAR(20) NOT NULL,
            password VARCHAR(40) NOT NULL,
            created_at DATETIME,
            PRIMARY KEY(id),
            UNIQUE KEY username_index(username)
        ) ENGINE = INNODB;
        ';

        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration.
     */
    public function down()
    {
        $sql = 'DROP TABLE users';
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
