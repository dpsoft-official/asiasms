<?php

require_once '../vendor/autoload.php';

use Dpsoft\Asiasms\Asiasms;

try{
    $asiasms = new Asiasms('username', 'password');
    $batchId = $asiasms->getMessages('20180821');
}catch (\Throwable $exception){
    echo $exception->getMessage();
}