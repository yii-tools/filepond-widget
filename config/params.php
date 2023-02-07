<?php

declare(strict_types=1);

return [
    'yii-tools/filepond-widget' => [
        'translator' => [
            'defaultCategory' => 'filepond',
            'path' => '@filepond/resources/messages',
        ],
    ],

    'yiisoft/aliases' => [
        'aliases' => [
            '@filepond' => '@vendor/yii-tools/filepond-widget',
        ],
    ],
];
