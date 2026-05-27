<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$smsPilotApiKey = $_ENV['SMSPILOTRU_API_KEY'] ? $_ENV['SMSPILOTRU_API_KEY'] : '';
$smsPilotEmulateRequest = $_ENV['SMSPILOTRU_EMULATE_REQUEST'] ? (bool)$_ENV['SMSPILOTRU_EMULATE_REQUEST'] : true;

return [
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Book catalog test task',

    // preloading 'log' component
    'preload' => ['log'],

    // autoloading model and component classes
    'import' => [
        'application.models.*',
        'application.components.*',
        'application.services.*',
    ],

    'modules' => [
        'gii' => [
            'class' => 'system.gii.GiiModule',
            'password' => 'password',
            'ipFilters' => ['*'], // Только при разработке
        ],
    ],

    'components' => [

        'user' => [
            'allowAutoLogin' => true,
            'loginUrl' => ['site/login'],
        ],

        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],

        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),

        'errorHandler' => [
            // use 'site/error' action to display errors
            'errorAction' => YII_DEBUG ? null : 'site/error',
        ],

        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ],
                // uncomment the following to show log messages on web pages
                /*
                [
                    'class' => 'CWebLogRoute',
                ],
                */
            ],
        ],

        'smsSender' => [
            'class' => 'application.components.SmsSender',
            'apiKey' => $smsPilotApiKey,
            'emulateRequest' => $smsPilotEmulateRequest,
        ],

    ],

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => [
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ],
];