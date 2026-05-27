<?php

class m260526_132824_insert_test_user extends CDbMigration
{
	public function up()
	{
        $passwordHash = password_hash($this->getPassword(), PASSWORD_DEFAULT);
        $now = time();
        $this->insert('user', [
            'email' => $this->getEmail(),
            'password_hash' => $passwordHash,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
	}

	public function down()
	{
        $this->delete('user', 'email = :email', [':email' => $this->getEmail()]);
	}

    private function getEmail(): string
    {
        return $_ENV['TEST_USER_EMAIL'] ? $_ENV['TEST_USER_EMAIL'] : 'testuser@example.com';
    }

    private function getPassword(): string
    {
        return $_ENV['TEST_USER_PASSWORD'] ? $_ENV['TEST_USER_PASSWORD'] : 'password';
    }
}