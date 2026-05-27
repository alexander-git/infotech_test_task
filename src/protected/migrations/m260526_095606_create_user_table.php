<?php

class m260526_095606_create_user_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('user', [
            'id' => 'pk',
            'email' => 'string NOT NULL',
            'password_hash' => 'string NOT NULL',
            'created_at' => 'integer NOT NULL',
            'updated_at' => 'integer NOT NULL',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        $this->createIndex('idx__user__email', 'user', 'email', true);
	}

	public function down()
	{
        $this->dropTable('user');
	}
}
