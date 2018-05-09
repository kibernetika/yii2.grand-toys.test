<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Goods;

/**
 * GoodsSearch represents the model behind the search form of `app\models\Goods`.
 */
class GoodsSearch extends Goods
{
    public $category;
    public $brand;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_goods', 'id_category', 'id_brand', 'code'], 'integer'],
            [['name', 'color', 'category', 'brand'], 'safe'],
            [['price', 'width', 'height', 'lenght'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Goods::find();
        $query->joinWith(['category']);
        $query->joinWith(['brand']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['category'] = [
            'asc' => ['id_category' => SORT_ASC],
            'desc' => ['id_category' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['brand'] = [
            'asc' => ['brand.name' => SORT_ASC],
            'desc' => ['brand.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_goods' => $this->id_goods,
            'goods.id_category' => $this->id_category,
            'goods.id_brand' => $this->id_brand,
            'code' => $this->code,
            'price' => $this->price,
            'width' => $this->width,
            'height' => $this->height,
            'lenght' => $this->lenght,
        ]);

        $query->andFilterWhere(['like', 'goods.name', $this->name])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'category.name', $this->category])
            ->andFilterWhere(['like', 'brand.name', $this->brand]);
        return $dataProvider;
    }
}
