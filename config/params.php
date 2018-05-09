<?php

return [
    'adminEmail' => 'deni.ecybernetics@gmail.com',
    'supportEmail' => 'deni.ecybernetics@gmail.com',
    'user.passwordResetTokenExpire' => 3600,
    'secretKeyExpire' => 3600,
    'emailActivation' => true,
    'loginWithEmail' => true,
    'maskMoneyOptions' => [
        'prefix' => 'UAH ',
        'suffix' => ' ₴',
        'affixesStay' => true,
        'thousands' => ' ',
        'decimal' => ',',
        'precision' => 2,
        'allowZero' => false,
        'allowNegative' => false,
    ]
];
