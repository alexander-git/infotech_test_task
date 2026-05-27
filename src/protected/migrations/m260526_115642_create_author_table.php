<?php

class m260526_115642_create_author_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('author', [
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'surname' => 'string NOT NULL',
            'patronymic' => 'string DEFAULT ""'
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        $this->createIndex('idx__author__surname__name', 'author', ['surname', 'name'], true);
	}

	public function down()
	{
        $this->dropTable('author');
	}

}