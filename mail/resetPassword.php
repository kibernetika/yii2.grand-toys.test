<?php
/**
 * Created by PhpStorm.
 * User: 13
 * Date: 09.05.2018
 * Time: 6:52
 */
use yii\helpers\Html;
echo 'Привет '.Html::encode($user->username).'. ';
echo Html::a('Changing password:',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            '/site/reset-password',
            'key' => $user->secret_key
        ]
    ));