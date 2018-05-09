<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
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
    <?php $form = ActiveForm::begin(); ?>

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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'price',
        ['inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model->price)]]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'width')->textInput() ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'lenght')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            'New' :
            'Edit',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
