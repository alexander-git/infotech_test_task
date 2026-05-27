<?php

/**
 * @property integer $id
 * @property string $title
 * @property integer $year
 * @property string $isbn
 * @property string $description
 * @property string $main_page_photo_url
 * @property-read string $authorsString
 * @property BookAuthor[] $bookAuthors
 * @property Author[] $authors
 */
class Book extends CActiveRecord
{
    const SCENARIO_SAVE_WITH_AUTHORS = 'saveWithAuthors';
    const SCENARIO_SEARCH = 'search';

    public array $authorIds = [];

	public function tableName(): string
	{
		return 'book';
	}

	public function rules(): array
	{
		return [
            ['title', 'required'],
            ['title',  'length', 'max' => 255],
            ['year', 'required'],
            ['year', 'numerical', 'integerOnly'=>true],
            ['isbn', 'required'],
            ['isbn', 'length', 'max' => 20],
			['main_page_photo_url', 'length', 'max' => 2048],
            ['main_page_photo_url', 'url', 'allowEmpty' => true],
			['description', 'safe'],
            ['authorIds', 'validateAuthorIds', 'on' => self::SCENARIO_SAVE_WITH_AUTHORS],
            [['id, title, year, isbn, description'], 'safe', 'on' => self::SCENARIO_SEARCH],
		];
	}


	public function relations(): array
	{
		return [
			'bookAuthors' => [self::HAS_MANY, 'BookAuthor', 'book_id'],
            'authors' => [self::MANY_MANY, 'Author', 'book_author(book_id, author_id)'],
		];
	}

	public function attributeLabels(): array
	{
		return [
			'id' => 'ID',
			'title' => 'Название',
			'year' => 'Год',
			'isbn' => 'ISBN',
			'description' => 'Описание',
			'main_page_photo_url' => 'Фотография главной страницы',
		];
	}

	/**
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function search(): CActiveDataProvider
    {
        $criteria = new CDbCriteria();
        $criteria->with = ['authors'];
        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('year', $this->year);
        $criteria->compare('isbn', $this->isbn, true);
        $criteria->compare('description', $this->description, true);
        return new CActiveDataProvider($this, ['criteria' => $criteria]);
    }

    public function getAuthorsString(): string
    {
        return implode(', ', array_map(
            static fn(Author $author): string => $author->fullName,
            $this->authors
        ));
    }

    public function validateAuthorIds($attribute, $params): void
    {
        if (empty($this->authorIds)) {
            $this->addError($attribute, 'Укажите хотя бы одного автора');
        }
    }

    /**
     * @throws Throwable
     */
    public function saveWithAuthors(): bool
    {
        $needNotify = $this->isNewRecord;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            if (!$this->save()) {
                $transaction->rollback();
                return false;
            }

            BookAuthor::model()->deleteAllByAttributes([
                'book_id' => $this->id,
            ]);

            foreach ($this->authorIds as $authorId) {
                $bookAuthor = new BookAuthor();
                $bookAuthor->book_id = $this->id;
                $bookAuthor->author_id = (int)$authorId;
                if (!$bookAuthor->save()) {
                    throw new Exception('Ошибка сохранения привязки автора к книге');
                }
            }

            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollback();
            throw $e;
        }

        if ($needNotify) {
            NotifyService::notifySubscribersAboutNewBook($this->id);
        }

        return true;
    }

    public static function getAllAvailableYears(): array
    {
        return Yii::app()->db->createCommand()
            ->selectDistinct('year')
            ->from('book')
            ->order('year ASC')
            ->queryColumn();
    }
}
