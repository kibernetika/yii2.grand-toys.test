<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use app\assets\ModalAsset;
use app\models\Category;
use app\models\Brand;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

ModalAsset::register($this);
$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php
    Modal::begin([
        'id' => 'comm',
        'header' => 'New goods',
        'toggleButton' => [
            'class' => 'btn btn-success',
            'label' => 'Create',
            'tag' => 'a',
            'data-target' => '#comm',
            'href' => \yii\helpers\Url::to(['/goods/create']),
        ],
        'clientOptions' => false,
    ]);
    Modal::end();
    ?>

    <?php
        yii\bootstrap\Modal::begin([
            'id'=>'editModalId',
            'class' =>'modal',
            'size' => 'modal-md',
        ]);
        echo "<div class='modalContent'></div>";
        yii\bootstrap\Modal::end();
    ?>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a('Create Goods', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'name',
                'value'=>'name',
                'contentOptions'=>['style'=>'min-width: 200px;']
            ],
            [
                'attribute' => 'id_category',
                'value' => 'category.name',
                'filter' => Html::activeDropDownList(
                    $searchModel, 'category', ArrayHelper::map(
                    Category::find()->orderBy(['name' => SORT_ASC])->asArray()->all(),
                    'id_category',
                    'name'
                ), ['class'=>'form-control','prompt' => 'All', 'style'=>'min-width: 150px;']),
            ],
            [
                'attribute' => 'id_brand',
                'value' => 'brand.name',
                'filter' => Html::activeDropDownList(
                    $searchModel, 'brand', ArrayHelper::map(
                    Brand::find()->orderBy(['name' => SORT_ASC])->asArray()->all(),
                    'id_brand',
                    'name'
                ), ['class'=>'form-control','prompt' => 'All', 'style'=>'min-width: 150px;']),
            ],
            'code',
            'price',
            'color',
            'width',
            'height',
            'lenght',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{edit}',
                'template' => '{view} {edit} {delete} ',
                'buttons' =>[
                    'edit' => function ($url, $model) {
                        // Html::a args: title, href, tag properties.
                        return Html::a( '<span class="glyphicon glyphicon-pencil"></span>',
                            ['goods/update', 'id'=>$model['id_goods']],
                            ['class'=>' btn-xs btn-default modalButton', 'title'=>'Update', ]
                        );
                    },
                ],
                'contentOptions'=>['style'=>'width: 80px;']
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
