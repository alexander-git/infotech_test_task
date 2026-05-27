<?php

class m260526_121437_create_subscription_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('subscription', [
            'id' => 'pk',
            'phone' => 'string NOT NULL',
            'author_id' => 'integer NOT NULL',
            'created_at' => 'integer NOT NULL',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        $this->createIndex('idx__subscription__unique', 'subscription', ['phone', 'author_id'], true);
        $this->addForeignKey('fk__subscription__author_id', 'subscription', 'author_id', 'author', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('subscription');
    }
}