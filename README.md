# Asiasms new panel webservice

[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

Asiasms is a SMS service provider system.
# Is right for me?
If you need integration your website(send and received SMS) with Asiasms, you are in the right place.

# Requirements
<ul>
<li> For take username and password contarct with http://asiasms.ir</li>
<li> For use the allowed IP must define in asiasms panel</li>
</ul>

#Installation
``` bash
$ composer require dpsoft/asiasms
```

#Methods

####GetCredit
Get credit of Asiasms panel.
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    $asiasms = new Asiasms('username', 'password');
    echo $asiasms->getCredit();
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```

####bulkSend
Send message to list of mobiles
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string username Asiasms panel username required
      *@param string password Webservice password set in Asiasms panel. required
      */
    $asiasms = new Asiasms('username', 'password');
    /**
      *@param string $message | required
      *@param array $receivers example: ['09100000000', '09111111111'] | required
      *$receivers should be in 09xxxxxxx format
      *@param string $senderId the number sms send with it(must exist in panel) default panel default number | optional 
      *@param string $udh default null | optional
      *@param bool $isFlash default false | optional
      */
    $batchId = $asiasms->bulkSend('message', 'number', 'senderId', 'udh', 'isFlash');
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```

####Send
Send message to one mobile number.
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string username Asiasms panel username required
      *@param string password Webservice password set in Asiasms panel. required
      */
    $asiasms = new Asiasms('username', 'password');
    /**
      *@param string $message | required
      *@param string $numbers example: '09100000000' | required
      *@param string $senderId the number sms send with it(must exist in panel) default panel default number | optional 
      *@param string $udh default null | optional
      *@param bool $isFlash default false | optional
      */
    $batchId = $asiasms->send('message', 'number', 'senderId', 'udh', 'isFlash');
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```
####GetMessage
Get list of sms received to panel
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string username Asiasms panel username required
      *@param string password Webservice password set in Asiasms panel. required
      */
    $asiasms = new Asiasms('username', 'password');
    /**
      *@param string $Date date for get report in 20150811 format | required
      *@param string $receiver panel number | optional
      */
    $batchId = $asiasms->getMessages('$Date', 'receiver');
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```
