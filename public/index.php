<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/ApplicationFactory.php';

$app = ApplicationFactory::create();

$app->run();
