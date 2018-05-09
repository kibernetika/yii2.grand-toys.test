<?php
/**
 * Created by PhpStorm.
 * User: 13
 * Date: 09.05.2018
 * Time: 6:51
 */

use yii\helpers\Html;
echo 'Hello '.Html::encode($user->username).'.';
echo Html::a('Activation account:',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            '/site/activate-account',
            'key' => $user->secret_key
        ]
    ));