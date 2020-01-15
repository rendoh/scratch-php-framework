<?php

use Phpmig\Migration\Migration;

class Following extends Migration
{
    /**
     * Do the migration.
     */
    public function up()
    {
        $sql = '
        CREATE TABLE followings (
            user_id INTEGER,
            following_id INTEGER,
            PRIMARY KEY(user_id, following_id)
        ) ENGINE = INNODB;

        ALTER TABLE following ADD FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE;
        ALTER TABLE following ADD FOREIGN KEY (following_id) REFERENCES user(id) ON DELETE CASCADE;
        ';

        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration.
     */
    public function down()
    {
        $sql = 'DROP TABLE followings';
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
