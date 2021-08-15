<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 */
class m210809_145624_create_products_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		
		$this->createTable('products', [
			'id'           => $this->primaryKey()->unsigned(),
			'product_code' => $this->string(255),
			'category'     => $this->string(255),
			'short_desc'   => $this->string(255),
			'long_desc'    => $this->text(),
			'price'        => $this->decimal(),
			'photo_url'    => $this->string(255),
			'created_at'   => $this->dateTime(),
			'updated_at'   => $this->dateTime()->append('ON UPDATE CURRENT_TIMESTAMP'),
			'deleted_at'   => $this->dateTime(),
			'created_by'   => $this->integer()->unsigned()->notNull(),
			'updated_by'   => $this->integer()->unsigned()->notNull(),
			'deleted_by'   => $this->integer()->unsigned()->notNull(),
		]);

		$this->addForeignKey('products_created_by_fk', 'products', 'created_by', 'admin', 'id');
		$this->addForeignKey('products_updated_by_fk', 'products', 'updated_by', 'admin', 'id');
		$this->addForeignKey('products_deleted_by_fk', 'products', 'deleted_by', 'admin', 'id');

		$this->createIndex('id', 'products', ['id']);
		$this->createIndex('product_code', 'products', ['product_code']);
		$this->createIndex('category', 'products', ['category']);
		$this->createIndex('short_desc', 'products', ['short_desc']);
		$this->createIndex('price', 'products', ['price']);
		$this->createIndex('created_at', 'products', ['created_at']);
		$this->createIndex('deleted_at', 'products', ['deleted_at']);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('products');
	}
}