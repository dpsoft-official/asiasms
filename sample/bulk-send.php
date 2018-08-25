<?php

require_once '../vendor/autoload.php';

use Dpsoft\Asiasms\Asiasms;

try {
    $asiasms = new Asiasms('username', 'password');
    print_r($asiasms->bulkSend('تست پیامک یک', ['mobilenumber1', 'mobilenumber2'], '', 'testudh', false));
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}