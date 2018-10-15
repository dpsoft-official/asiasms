<?php

require_once '../vendor/autoload.php';

use Dpsoft\Asiasms\Asiasms;

try{
    $asiasms = new Asiasms('username', 'password');
    $messages = $asiasms->getMessagesBetweenDate('2018-10-14', '2018-10-15');
    print_r($messages);
}catch (\Throwable $exception){
    echo $exception->getMessage();
}