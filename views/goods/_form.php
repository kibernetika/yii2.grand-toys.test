<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\money\MaskMoney;
use kartik\color\ColorInput;
/* @var $this yii\web\View */
/* @var $model app\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#new_goods").on("pjax:end", function() {
                $.pjax.reload({container:"#goods"});  
        });
    });'
);
?>

<div class="goods-form">

    <?php yii\widgets\Pjax::begin(['id' => 'new_goods']) ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?
        $category = \app\models\Category::find()->all();
        $items = \yii\helpers\ArrayHelper::map($category,'id_category','name');
        $params = [
            'prompt' => 'Select category...'
        ];
        echo $form->field($model, 'id_category')->dropDownList($items,$params);
    ?>

    <?
        $brand = \app\models\Brand::find()->all();
        $items = \yii\helpers\ArrayHelper::map($brand,'id_brand','name');
        $params = [
            'prompt' => 'Select brand...'
        ];
        echo $form->field($model, 'id_brand')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <? echo $form->field($model, 'price')->widget(MaskMoney::class, [
            'pluginOptions' => ['allowNegative' => false]
        ]);
    ?>

    <?= $form->field($model, 'color')->widget(ColorInput::class, [
        'options' => ['placeholder' => 'Select color ...'],
    ]); ?>

    <?= $form->field($model, 'width')->textInput() ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'lenght')->textInput() ?>

    <? if(!empty($model->photo)){
        echo Html::img(Url::home(true) . $model->photo, $options = ['class' => 'postImg', 'style' => ['width' => '180px']]);
        echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['goods/deleteimage', 'id' => $model->id_goods], [
            'onclick'=>
                 "$.ajax({
                 type:'POST',
                 cache: false,
                 url: '".Url::to(['goods/deleteimage', 'id' => $model->id_goods])."',
                 success  : function(response) {
                     $('.link-del').html(response);
                     $('.postImg').remove();
                 }
                });
            return false;
         $('.postImg').remove(); 
         ",
         'class' => 'link-del'
    ]);
    } ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            'New' :
            'Edit',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
