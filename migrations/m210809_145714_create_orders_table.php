<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m210809_145714_create_orders_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('orders', [
			'id'           => $this->primaryKey()->unsigned(),
			'order_number' => $this->string(255),
			'user_id'      => $this->integer()->unsigned()->notNull(),
			'created_at'   => $this->dateTime(),
			'updated_at'   => $this->dateTime()->append('ON UPDATE CURRENT_TIMESTAMP'),
			'deleted_at'   => $this->dateTime(),
		]);

		$this->addForeignKey('orders_user_id_fk', 'orders', 'user_id', 'users', 'id');

		$this->createIndex('id', 'orders', ['id']);
		$this->createIndex('order_number', 'orders', ['order_number']);
		$this->createIndex('user_id', 'orders', ['user_id']);
		$this->createIndex('created_at', 'orders', ['created_at']);
		$this->createIndex('deleted_at', 'orders', ['deleted_at']);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('orders');
	}
}
