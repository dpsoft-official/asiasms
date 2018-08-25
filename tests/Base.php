<?php
/**
 * Created by PhpStorm.
 * User: Hossein
 * Date: 8/16/2018
 * Time: 9:45 AM
 */

namespace Tests;


use DOMDocument;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class Base extends TestCase
{
    public function getCreditMock()
    {
        $mock = new MockHandler(
            [
                new Response(
                    200, [],
                    json_encode(['IsSuccessful' => 1, 'StatusCode' => 0, 'Credit' => 1000, 'Message' => '', 'StackTrace' => ''])
                ), new RequestException(
                "Error Communicating with Server",
                new Request('GET', 'test')
            )
            ]
        );
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        return $client;
    }

    public function sendMessageMock()
    {
        $mock = new MockHandler(
            [
                new Response(
                    200, [],
                    json_encode(['IsSuccessful' => 1, 'StatusCode' => 0, 'BatchId' => '123456', 'Message' => '', 'StackTrace' => ''])
                ), new RequestException(
                "Error Communicating with Server",
                new Request('GET', 'test')
            )
            ]
        );
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        return $client;
    }

    public function getMessagesMock()
    {
        for ($i = 0; $i < 5; $i++) {
            $sms[$i] = new \stdClass();
            $sms[$i]->From = '989131111111';
            $sms[$i]->To = '50000000';
            $sms[$i]->Text = 'test message';
            $sms[$i]->ReceiveDateTime = '2018-08-18 10:51:00';
        }

        $responseArray = ['IsSuccessful' => true, 'StatusCode' => 0, 'ReceivedMessages' => 'From'];

        $xml = new SimpleXMLElement('<ResponseMessage/>');
        array_walk_recursive($responseArray, array ($xml, 'addChild'));

        $mock = new MockHandler(
            [
                new Response(
                    200, [],$xml->asXML()

                ), new RequestException(
                "Error Communicating with Server",
                new Request('GET', 'test')
            )
            ]
        );
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        return $client;
    }

}