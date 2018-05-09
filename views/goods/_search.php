<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;
use kartik\color\ColorInput;

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
            'prompt' => 'Select brand...'
        ];
        echo $form->field($model, 'brand')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <? echo $form->field($model, 'price')->widget(\kartik\money\MaskMoney::class, [
        'pluginOptions' => ['allowNegative' => false]
    ]);
    ?>

    <?= $form->field($model, 'color')->widget(ColorInput::class, [
        'options' => ['placeholder' => 'Select color ...'],
    ]); ?>

    <?php  echo $form->field($model, 'width') ?>

    <?php  echo $form->field($model, 'height') ?>

    <?php  echo $form->field($model, 'lenght') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
