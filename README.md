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
Get list of sms received to panel in date (messages just return one time. the limitation from Asiasms)
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string username Asiasms panel username required
      *@param string password Webservice password set in Asiasms panel. required
      */
    $asiasms = new Asiasms('username', 'password');
    /**
      *@param string date, date for get report in 20150811 format | required
      *@param string receiver, panel number | optional
      *
      *return array of messages
      */
    $messages = $asiasms->getMessages('date', 'receiver');
    
    print_r($messages);
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```

####Get messages between two date
Get list of sms received to panel between two dates (range of dates)
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string username Asiasms panel username required
      *@param string password Webservice password set in Asiasms panel. required
      */
    $asiasms = new Asiasms('username', 'password');
    /**
      *@param string start date, in 2018-08-11 format | required
      *@param string end date, in 2018-08-11 format | required
      *@param string receiver, panel number | optional
      *
      *return array of messages
      */
    $messages = $asiasms->getMessagesBetweenDate('start date', 'end date');
    
    print_r($messages);
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```
