<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m210809_145704_create_cart_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('cart', [
			'id'         => $this->primaryKey()->unsigned(),
			'user_id'    => $this->integer()->unsigned()->notNull(),
			'product_id' => $this->integer()->unsigned()->notNull(),
			'quantity'   => $this->decimal(),
			'created_at'   => $this->dateTime(),
			'updated_at'   => $this->dateTime()->append('ON UPDATE CURRENT_TIMESTAMP'),
			'deleted_at'   => $this->dateTime(),
		]);

		$this->addForeignKey('cart_user_id_fk', 'cart', 'user_id', 'users', 'id');
		$this->addForeignKey('cart_product_id_fk', 'cart', 'product_id', 'products', 'id');

		$this->createIndex('id', 'cart', ['id']);
		$this->createIndex('user_id', 'cart', ['user_id']);
		$this->createIndex('product_id', 'cart', ['product_id']);
		$this->createIndex('quantity', 'cart', ['quantity']);
		$this->createIndex('created_at', 'cart', ['created_at']);
		$this->createIndex('deleted_at', 'cart', ['deleted_at']);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('cart');
	}
}
