<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_details".
 *
 * @property int $id
 * @property int $oder_id
 * @property int $product_id
 * @property float|null $price
 * @property float|null $quantity
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Orders $oder
 * @property Products $product
 */
class OrdersDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oder_id', 'product_id'], 'required'],
            [['oder_id', 'product_id'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['status'], 'string', 'max' => 255],
            [['oder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['oder_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oder_id' => 'Oder ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * Gets query for [[Oder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'oder_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
