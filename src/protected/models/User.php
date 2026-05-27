<?php

/**
 * @property integer $id
 * @property string $email
 * @property string $password_hash
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends CActiveRecord
{
	public function tableName(): string
	{
		return 'user';
	}

	/**
	 * @return array
	 */
	public function rules(): array
	{
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'length', 'max' => 255],
            ['email', 'unique'],
            ['password_hash', 'required', 'on' => 'insert'],
            ['password_hash', 'length', 'max' => 255],
        ];
	}

	/**
	 * @return array
	 */
	public function attributeLabels(): array
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password_hash' => 'Password Hash',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}

	/**
	 * @return User the static model class
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
                'updateAttribute' => 'updated_at',
                'setUpdateOnCreate' => true,
            ],
        ];
    }

    public function setPassword($password): void
    {
        $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
    }

    public function validatePassword($password): bool
    {
        return password_verify($password, $this->password_hash);
    }
}
