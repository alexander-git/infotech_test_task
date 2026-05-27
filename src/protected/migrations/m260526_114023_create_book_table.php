<?php

class m260526_114023_create_book_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('book', [
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'year' => 'integer NOT NULL',
            'isbn' => 'varchar(20) NOT NULL',
            'description' => 'text',
            'main_page_photo_url' => 'varchar(2048) DEFAULT ""',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        $this->createIndex('idx__book__year', 'book', 'year');
	}

	public function down()
	{
        $this->dropTable('book');
	}
}
