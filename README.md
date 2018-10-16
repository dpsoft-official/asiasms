# Asiasms new panel webservice

[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

Asiasms is a SMS service provider system.
# Is right for me?
If you need integration your website(send and received SMS) with Asiasms, you are in the right place.

# Requirements
<ul>
<li> For take username and password contarct with http://asiasms.ir</li>
<li> The allowed IP must define in asiasms panel</li>
</ul>

# Installation
``` bash
$ composer require dpsoft/asiasms
```

# Methods

#### GetCredit
Get credit of Asiasms panel.
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string $username (required) Asiasms panel username 
      * 
      *@param string $password (required) webservice password set in Asiasms panel.
      */
    $asiasms = new Asiasms($username, $password);
    echo $asiasms->getCredit();
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```

#### bulkSend
Send message to list of numbers
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string $username (required) Asiasms panel username 
      * 
      *@param string $password (required) webservice password set in Asiasms panel.
      */
    $asiasms = new Asiasms($username, $password);
    
    /**
      *@param string $message (required) message text
      *@param array $receivers (required) example: ['09100000000', '09111111111'] should be in 09xxxxxxx mask
      *@param string $senderId = null (optional) the number sms send with it(must exist in panel) default panel default number 
      *@param string $udh = null (optional)
      *@param bool $isFlash = null (optional) if send bool true or false the webservice not work
      */
    $batchId = $asiasms->bulkSend($message, $receivers, $senderId, $udh, $isFlash);
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```

#### Send
Send message to one number.
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string $username (required) Asiasms panel username 
      * 
      *@param string $password (required) webservice password set in Asiasms panel.
      */
    $asiasms = new Asiasms($username, $password);
    
    /**
      *@param string $message (required) message text
      *@param string $number (required) example: '09100000000' the receiver number
      *@param string $senderId = null (optional) the number sms send with it(must exist in panel) default panel default number 
      *@param string $udh = null (optional)
      *@param bool $isFlash = null (optional) if send bool true or false the webservice not work
      */
    $batchId = $asiasms->send($message, $number, $senderId, $udh, $isFlash);
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```
#### GetMessage
Get list of sms received to panel in date (messages just return one time. the limitation from Asiasms)  

```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string $username (required) asiasms panel username 
      * 
      *@param string $password (required) webservice password set in Asiasms panel.
      */
    $asiasms = new Asiasms($username, $password);
    
    /**
      *@param string $date (required) date for get report in 20150811 format | required
      *@param string $receiver = '' (optional) panel number
      *
      *return array of messages
      */
    $messages = $asiasms->getMessages($date, $receiver);
    
    print_r($messages);
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```

#### GetMessagesBetweenDate
Get list of sms received to panel between two dates.(range of dates)
For get messages in one date set same start and end date .
```php
<?php use Dpsoft\Asiasms\Asiasms;

try{
    /**
      *@param string $username (required) asiasms panel username 
      * 
      *@param string $password (required) webservice password set in Asiasms panel.
      */
    $asiasms = new Asiasms($username, $password);
    
    /**
      *@param string $startDate (required) in 2018-08-11 format
      *@param string $endDate (required) in 2018-08-11 format
      *@param string $receiver = '' (optional) panel number
      *
      *return array of messages
      */
    $messages = $asiasms->getMessagesBetweenDate($startDate, $endDate, $receiver);
    
    print_r($messages);
}catch (\Throwable $exception){
    echo $exception->getMessage();
}
```

#### Example for return array of messages from Asiasms panel:
```php
Array
(
    [0] => Array
        (
            [From] => 98913xxxxxxx
            [To] => 3000xxxxxx
            [Text] => Message text
            [ReceiveDateTime] => 2018-10-14T17:46:29
        )

    [1] => Array
        (
            [From] => 98913xxxxxxx
            [To] => 3000xxxxxx
            [Text] => Message text for test
            [ReceiveDateTime] => 2018-10-14T18:10:40
        )
)
```

## License

[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

Copyright (c) 2018 dpsoft.ir
