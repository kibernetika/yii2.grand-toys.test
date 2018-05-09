<?php
/**
 * Created by PhpStorm.
 * User: 13
 * Date: 09.05.2018
 * Time: 7:04
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\SendEmailForm */
/* @var $form ActiveForm */
?>
<div class="main-sendEmail">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- main-sendEmail -->