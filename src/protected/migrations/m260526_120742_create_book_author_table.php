<?php

class m260526_120742_create_book_author_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('book_author', [
            'id' => 'pk',
            'book_id' => 'integer NOT NULL',
            'author_id' => 'integer NOT NULL',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        $this->createIndex('idx__book_author__unique', 'book_author', ['book_id', 'author_id'], true);
        $this->addForeignKey('fk__book_author__book_id', 'book_author', 'book_id', 'book', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk__book_author__author_id', 'book_author', 'author_id', 'author', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropTable('book_author');
	}
}