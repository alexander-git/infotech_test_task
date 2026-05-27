<?php

/**
 * @property integer $id
 * @property string $phone
 * @property integer $author_id
 * @property integer $created_at
 * @property Author $author
 */
class Subscription extends CActiveRecord
{
	public function tableName(): string
	{
		return 'subscription';
	}

	public function rules(): array
	{
		return [
            ['phone', 'required'],
            ['phone', 'length', 'max' => 255],

            ['author_id', 'required'],
            ['author_id', 'numerical', 'integerOnly'=>true],
		];
	}

	public function relations(): array
	{
		return [
			'author' => [self::BELONGS_TO, 'Author', 'author_id'],
		];
	}


	public function attributeLabels(): array
	{
		return [
			'id' => 'ID',
			'phone' => 'Телефон',
			'author_id' => 'Автор',
			'created_at' => 'Created At',
		];
	}

	/**
	 * @return Subscription the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors(): array
    {
        return [
            'CTimestampBehavior' => [
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => null,
            ],
        ];
    }

    public static function getPhonesByBookId(int $bookId): array
    {
        return Yii::app()->db->createCommand()
            ->selectDistinct('s.phone')
            ->from('subscription s')
            ->join('book_author ba', 'ba.author_id = s.author_id')
            ->where('ba.book_id = :bookId', [':bookId' => $bookId])
            ->queryColumn();
    }
}
