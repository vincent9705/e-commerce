<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders_detai}}`.
 */
class m210809_145726_create_orders_details_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('orders_details', [
			'id'         => $this->primaryKey()->unsigned(),
			'order_id'    => $this->integer()->unsigned()->notNull(),
			'product_id' => $this->integer()->unsigned()->notNull(),
			'price'      => $this->decimal(),
			'quantity'   => $this->decimal(),
			'status'     => $this->string(255),
			'created_at' => $this->dateTime(),
			'updated_at' => $this->dateTime()->append('ON UPDATE CURRENT_TIMESTAMP'),
			'deleted_at' => $this->dateTime(),
		]);

		$this->addForeignKey('orders_details_order_id_fk', 'orders_details', 'order_id', 'orders', 'id');
		$this->addForeignKey('orders_details_product_id_fk', 'orders_details', 'product_id', 'products', 'id');

		$this->createIndex('id', 'orders_details', ['id']);
		$this->createIndex('order_id', 'orders_details', ['order_id']);
		$this->createIndex('product_id', 'orders_details', ['product_id']);
		$this->createIndex('price', 'orders_details', ['price']);
		$this->createIndex('quantity', 'orders_details', ['quantity']);
		$this->createIndex('status', 'orders_details', ['status']);
		$this->createIndex('created_at', 'orders_details', ['created_at']);
		$this->createIndex('deleted_at', 'orders_details', ['deleted_at']);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('orders_detail}');
	}
}