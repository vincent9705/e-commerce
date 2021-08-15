<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stocks`.
 */
class m210809_145648_create_stocks_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('stocks', [
			'id'         => $this->primaryKey()->unsigned(),
			'product_id' => $this->integer()->unsigned()->notNull(),
			'quantity'   => $this->decimal(),
			'created_at'   => $this->dateTime(),
			'updated_at'   => $this->dateTime()->append('ON UPDATE CURRENT_TIMESTAMP'),
			'deleted_at'   => $this->dateTime(),
			'created_by'   => $this->integer()->unsigned()->notNull(),
			'updated_by'   => $this->integer()->unsigned()->notNull(),
			'deleted_by'   => $this->integer()->unsigned()->notNull(),
		]);

		$this->addForeignKey('stocks_product_id_fk', 'stocks', 'product_id', 'products', 'id');

		$this->createIndex('id', 'stocks', ['id']);
		$this->createIndex('product_id', 'stocks', ['product_id']);
		$this->createIndex('quantity', 'stocks', ['quantity']);
		$this->createIndex('created_at', 'stocks', ['created_at']);
		$this->createIndex('deleted_at', 'stocks', ['deleted_at']);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('stocks');
	}
}
