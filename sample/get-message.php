<?php

require_once '../vendor/autoload.php';

use Dpsoft\Asiasms\Asiasms;

try{
    $asiasms = new Asiasms('username', 'password');
    $messages = $asiasms->getMessages('20181013', '3000000000');
    print_r($messages);
}catch (\Throwable $exception){
    echo $exception->getMessage();
}