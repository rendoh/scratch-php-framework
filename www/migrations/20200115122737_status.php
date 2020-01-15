<?php

use Phpmig\Migration\Migration;

class Status extends Migration
{
    /**
     * Do the migration.
     */
    public function up()
    {
        $sql = '
        CREATE TABLE statuses (
            id INTEGER AUTO_INCREMENT,
            user_id INTEGER NOT NULL,
            body VARCHAR(255),
            created_at DATATIME,
            PRIMARY KEY(id),
            INDEX user_id index(user_id)
        ) ENGINE = INNODB;

        ALTER TABLE statuses ADD FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE;
        ';

        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration.
     */
    public function down()
    {
        $sql = 'DROP TABLE statuses';
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
