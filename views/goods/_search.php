<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

<!--    --><?//= $form->field($model, 'id_goods') ?>

    <?
        $category = \app\models\Category::find()->all();
        $items = \yii\helpers\ArrayHelper::map($category,'id_category','name');
        $params = [
            'prompt' => 'Select category...'
        ];
        echo $form->field($model, 'category')->dropDownList($items,$params);
    ?>

    <?
        $brand = \app\models\Brand::find()->all();
        $items = \yii\helpers\ArrayHelper::map($brand,'id_brand','name');
        $params = [
            'prompt' => 'Select category...'
        ];
        echo $form->field($model, 'brand')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?php  echo $form->field($model, 'price') ?>

    <?php  echo $form->field($model, 'color') ?>

    <?php  echo $form->field($model, 'width') ?>

    <?php  echo $form->field($model, 'height') ?>

    <?php  echo $form->field($model, 'lenght') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
