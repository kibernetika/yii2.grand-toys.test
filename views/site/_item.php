<?php
/**
 * Created by PhpStorm.
 * User: 13
 * Date: 09.05.2018
 * Time: 23:19
 */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="item">
    <h2><?= Html::encode($model->name) ?></h2>

    <?= HtmlPurifier::process($model->code) ?>
</div>