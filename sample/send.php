<?php

require_once '../vendor/autoload.php';

use Dpsoft\Asiasms\Asiasms;

try {
    $asiasms = new Asiasms('username', 'password');
    print_r($asiasms->send('تست پیامک یک', 'mobilenumber', '', 'testudh', false));
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}