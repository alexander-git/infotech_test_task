<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property-read string $fullName
 * @property-read ?int $bookCount
 * @property BookAuthor[] $bookAuthors
 * @property Subscription[] $subscriptions
 * @property Book[] $books
 */
class Author extends CActiveRecord
{
    public ?int $bookCount;

	public function tableName(): string
	{
		return 'author';
	}

	public function rules(): array
	{
		return [
            ['name', 'required'],
            ['name', 'length', 'max' => 255],
            ['surname', 'required'],
            ['surname', 'length', 'max' => 255],
            ['patronymic', 'length', 'max' => 255],
            [['id, name, surname, patronymic'], 'safe', 'on' => 'search'],
		];
	}

	public function relations(): array
	{
		return array(
			'bookAuthors' => [self::HAS_MANY, 'BookAuthor', 'author_id'],
			'subscriptions' => [self::HAS_MANY, 'Subscription', 'author_id'],
            'books' => [self::MANY_MANY, 'Book', 'book_author(author_id, book_id)'],
		);
	}

	public function attributeLabels(): array
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя',
			'surname' => 'Фамилия',
			'patronymic' => 'Отчество',
		);
	}

	/**
	 * @return Author the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function search(): CActiveDataProvider
    {
        $criteria = new CDbCriteria();
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('surname', $this->surname, true);
        $criteria->compare('patronymic', $this->patronymic, true);
        return new CActiveDataProvider($this, ['criteria' => $criteria]);
    }

    public function getFullName(): string
    {
        $parts = [
            $this->surname,
            $this->name,
            $this->patronymic
        ];

        return implode(' ', array_filter(
            $parts,
            static fn(?string $value): bool => $value !== null && $value !== '')
        );
    }

    public static function getAllAuthors(): array
    {
        return self::model()->findAll(['order' => 'surname ASC, name ASC']);
    }

    public static function getYearTopAuthors(int $year): array
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'a.*, COUNT(ba.book_id) AS bookCount';
        $criteria->alias = 'a';

        $criteria->join = '
            INNER JOIN book_author ba ON ba.author_id = a.id
            INNER JOIN book b ON b.id = ba.book_id
        ';

        $criteria->condition = 'b.year = :year';
        $criteria->params = [':year' => $year];

        $criteria->group = 'a.id';
        $criteria->order = 'bookCount DESC';
        $criteria->limit = 10;

        return Author::model()->findAll($criteria);
    }
}
