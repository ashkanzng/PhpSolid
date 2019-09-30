<?php

use Yaslife\Core\Kernel\Application;

require_once(__DIR__ . '/../vendor/autoload.php');

$app = new Application();
$app->boot()
    ->run($argv);
