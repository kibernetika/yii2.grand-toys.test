<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */
?>
<div class="main-login">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($model->scenario === 'loginWithEmail'): ?>
        <?= $form->field($model, 'email') ?>
    <?php else: ?>
        <?= $form->field($model, 'username') ?>
    <?php endif; ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Enter', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?= Html::a('Change password?', ['/site/send-email']) ?>

</div><!-- main-login -->