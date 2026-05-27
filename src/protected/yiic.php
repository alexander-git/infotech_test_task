<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__))->load();

// change the following paths if necessary
$yiic=dirname(__FILE__).'/vendor/yiisoft/yii/framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);
