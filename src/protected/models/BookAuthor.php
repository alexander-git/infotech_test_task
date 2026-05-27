<?php

/**
 * @property integer $id
 * @property integer $book_id
 * @property integer $author_id
 * @property Author $author
 * @property Book $book
 */
class BookAuthor extends CActiveRecord
{
	public function tableName(): string
	{
		return 'book_author';
	}

	public function rules(): array
	{
		return array(
            ['book_id', 'required'],
            ['book_id', 'numerical', 'integerOnly' => true],
            ['author_id', 'required'],
            ['author_id', 'numerical', 'integerOnly' => true],
		);
	}

	public function relations(): array
	{
		return [
			'author' => [self::BELONGS_TO, 'Author', 'author_id'],
			'book' => [self::BELONGS_TO, 'Book', 'book_id'],
		];
	}

	public function attributeLabels(): array
	{
		return [
			'id' => 'ID',
			'book_id' => 'Книга',
			'author_id' => 'Автор',
		];
	}

	/**
	 * @return BookAuthor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
