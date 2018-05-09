<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id_goods
 * @property int $id_category
 * @property int $id_brand
 * @property string $name
 * @property int $code
 * @property string $price
 * @property string $color
 * @property double $width
 * @property double $height
 * @property double $lenght
 *
 * @property Brand $brand
 * @property Category $category
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_category', 'id_brand', 'code'], 'integer'],
            [['id_category', 'name', 'code', 'price'], 'required'],
            [['price', 'width', 'height', 'lenght'], 'number'],
            [['name'], 'string', 'max' => 250],
            [['color'], 'string', 'max' => 12],
            [['id_brand'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::class, 'targetAttribute' => ['id_brand' => 'id_brand']],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['id_category' => 'id_category']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_goods' => 'Id Goods',
            'id_category' => 'Id Category',
            'id_brand' => 'Id Brand',
            'name' => 'Name',
            'code' => 'Code',
            'price' => 'Price',
            'color' => 'Color',
            'width' => 'Width',
            'height' => 'Height',
            'lenght' => 'Lenght',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id_brand' => 'id_brand']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id_category' => 'id_category']);
    }

    /**
     * @param int $ovymiru
     */
    public function setCategory()
    {
        return Category::findOne($this->id_category)->id_category;
    }

    /**
     * {@inheritdoc}
     * @return GoodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsQuery(get_called_class());
    }
}
