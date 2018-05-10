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
    <div class="img">
        <? echo Html::img(\yii\helpers\Url::home(true) . $model->photo, $options = ['class' => 'postImg', 'style' => ['width' => '100px']]);?>
    </div>
    <div class="info">
        <div class="info-general">
            Code: <?= HtmlPurifier::process($model->code) ?> <br>
            Category: <?= HtmlPurifier::process($model->category->name) ?> <br>
            Brand: <?= HtmlPurifier::process($model->brand->name) ?> <br>
            <h2><?= Html::encode($model->name) ?></h2>
            Price: <?= HtmlPurifier::process($model->price) ?> грн.
        </div>
        <div class="info-secondary">
            Color: <?= HtmlPurifier::process($model->color) ?> <br>
            Width: <?= HtmlPurifier::process($model->width) ?> <br>
            Height: <?= HtmlPurifier::process($model->height) ?> <br>
            Lenght: <?= HtmlPurifier::process($model->lenght) ?>
        </div>
    </div>
</div>
