<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin}}`.
 */
class m210809_145522_create_admin_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('admin', [
			'id'        => $this->primaryKey()->unsigned(),
			'user_name' => $this->string(255),
			'password'  => $this->string(255),
			'email'     => $this->string(255),
			'last_login' => $this->dateTime(),
			'created_at' => $this->dateTime(),
			'updated_at' => $this->dateTime()->append('ON UPDATE CURRENT_TIMESTAMP'),
			'deleted_at' => $this->dateTime(),
		]);

		$this->createIndex('id', 'admin', ['id']);
		$this->createIndex('user_name', 'admin', ['user_name']);
		$this->createIndex('created_at', 'admin', ['created_at']);
		$this->createIndex('deleted_at', 'admin', ['deleted_at']);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('admin');
	}
}
