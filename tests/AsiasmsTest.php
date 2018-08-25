<?php

namespace Tests;

use Dpsoft\Asiasms\Asiasms;
use Dpsoft\Asiasms\Exception\AsiasmsException;
use Respect\Validation\Exceptions\ValidationException;

class AsiasmsTest extends Base
{
    public function test_can_return_credit()
    {
        $asiasms = new Asiasms('test', 'test');
        $asiasms->setClient($this->getCreditMock());
        $response = $asiasms->getCredit();

        $this->assertEquals($response, 1000);
    }

    public function test_send_message_return_batchid()
    {
        $asiasms = new Asiasms('test', 'test');
        $asiasms->setClient($this->sendMessageMock());
        $response = $asiasms->bulkSend('test message', ['09111111111']);
        $this->assertEquals($response, '123456');
    }

    public function test_send_message_will_return_validation_exception()
    {
        $this->expectException(ValidationException::class);
        $asiasms = new Asiasms('test', 'test');
        $asiasms->setClient($this->sendMessageMock());
        $response = $asiasms->bulkSend('test character', ['09111111111', '989000000000'], '202020', 'test', true);
    }

    public function test_can_return_messages()
    {
        $asiasms = new Asiasms('test', 'test');
        $asiasms->setClient($this->getMessagesMock());
        $response = $asiasms->getMessages('20180818');
        $this->assertArrayHasKey('From', $response[0]);
        $this->assertArrayHasKey('To', $response[0]);
        $this->assertArrayHasKey('Text', $response[0]);
        $this->assertArrayHasKey('ReceiveDateTime', $response[0]);
        $this->assertEquals($response[0]['Text'], 'test message');
    }

}
