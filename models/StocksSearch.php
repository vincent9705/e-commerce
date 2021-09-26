<?php

namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use app\models\Stocks;

/**
 * Search represents the model behind the search form of `app\models\Stocks`.
 */
class StocksSearch extends Model//extends Stocks
{
    /**
     * {@inheritdoc}
     */
    public $id;
    public $product_id;
    public $short_desc;
    public $quantity;
    public $created_at;
    public $updated_at;
    public $deleted_at;
    public $created_by;
    public $updated_by;
    public $deleted_by;

    public function rules()
    {
        return [
            [['id', 'product_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['quantity'], 'number'],
            [['created_at', 'updated_at', 'deleted_at', 'short_desc'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    /* public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    } */

    public function search($params)
    {
        $query = Stocks::find();
        $query->leftJoin('products', 'products.id = stocks.product_id');
        $query->leftJoin('admin', 'admin.id = stocks.created_by');
        $query->select([
            'id'         => 'stocks.id',
            'product_id' => 'stocks.product_id',
            'short_desc' => 'products.short_desc',
            'quantity'   => 'stocks.quantity',
            'created_at' => 'stocks.created_at',
            'updated_at' => 'stocks.updated_at',
            'deleted_at' => 'stocks.deleted_at',
            'created_by' => 'admin.user_name',
            'updated_by' => 'admin.user_name',
            'deleted_by' => 'stocks.deleted_by',
        ]);
        // add conditions that should always apply here

        

        $this->load($params);

        /* if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        } */

        // grid filtering conditions
        $query->andFilterWhere([
            'sotcks.id'         => $this->id,
            'sotcks.product_id' => $this->product_id,
            'sotcks.quantity'   => $this->quantity,
            'sotcks.created_at' => $this->created_at,
            'sotcks.updated_at' => $this->updated_at,
            'sotcks.deleted_at' => $this->deleted_at,
            'admin.user_name'   => $this->created_by,
            'sotcks.updated_by' => $this->updated_by,
            'sotcks.deleted_by' => $this->deleted_by,
        ]);
        $query->andFilterWhere(['like', 'products.short_desc', $this->short_desc]);
        $query->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->asArray()->all(),
        ]);

        return $dataProvider;
    }
}
