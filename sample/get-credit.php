<?php

require_once '../vendor/autoload.php';

use Dpsoft\Asiasms\Asiasms;

try {
    $asiasms = new Asiasms('username', 'password');
    echo $asiasms->getCredit();
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}