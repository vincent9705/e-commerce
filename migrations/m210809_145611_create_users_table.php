<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210809_145611_create_users_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('users', [
			'id'        => $this->primaryKey()->unsigned(),
			'user_name' => $this->string(255),
			'password'  => $this->string(255),
			'email'     => $this->string(255),
			'last_login' => $this->dateTime(),
			'created_at' => $this->dateTime(),
			'updated_at' => $this->dateTime()->append('ON UPDATE CURRENT_TIMESTAMP'),
			'deleted_at' => $this->dateTime(),
		]);

		$this->createIndex('id', 'users', ['id']);
		$this->createIndex('user_name', 'users', ['user_name']);
		$this->createIndex('created_at', 'users', ['created_at']);
		$this->createIndex('deleted_at', 'users', ['deleted_at']);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('users');
	}
}
