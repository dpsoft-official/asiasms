<?php namespace Dpsoft\Asiasms;

use Dpsoft\Asiasms\Exception\AsiasmsException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

/**
 * Class Asiasms
 * @package Dpsoft\Asiasms
 */
class Asiasms
{
    const BASE_URL = 'http://185.37.53.188:8080';

    private $username, $password;
    /**
     * @var Client
     */
    private $client;

    /**
     * Asiasms constructor.
     *
     * @param string $username The Asiasms panel user name
     * @param string $password The webservice password set in Asiasms panel
     * @throws ValidationException
     */
    public function __construct(string $username, string $password)
    {
        v::notEmpty()->assert($username);
        v::notEmpty()->assert($password);

        $this->username = $username;
        $this->password = $password;

        $this->client = new Client(
            [
                'base_uri' => self::BASE_URL,
                'auth' => [$this->username, $this->password],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
            ]
        );
    }

    /**
     * Initialize Request for send to Asiasms
     *
     * @param $url (required)
     * @param array $data (required)
     * @param string $method = 'post' (optional)
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($url, $data = [], $method = 'post')
    {
        $body = $this->client->request(
            $method,
            $url,
            [
                'form_params' => $data,
            ]
        )->getBody();

        return $body;
    }

    /**
     * Send message to mobile
     *
     * mobile number should be in 09xxxxxxx format
     *
     * @param $smsText(required)
     * @param $receiver (required)
     * @param $senderId = null (optional)
     * @param $udh = null (optional)
     * @param $isFlash = null (optional)
     * @return string BatchId = null (optional)
     * @throws AsiasmsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($smsText, $receiver, $senderId = null, $udh = null, $isFlash = null)
    {
        return $this->bulkSend($smsText, [$receiver], $senderId, $udh, $isFlash);
    }

    /**
     * Send message to list of mobiles
     *
     * mobile number should be in 09xxxxxxx format
     *
     * @param string $smsText (required)
     * @param array $receivers (required)
     * @param string $senderId = null (optional)
     * @param string $udh = null (optional)
     * @param bool $isFlash = null (optional)
     * @return mixed
     * @throws AsiasmsException
     * @throws ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function bulkSend(
        string $smsText,
        array $receivers,
        string $senderId = null,
        string $udh = null,
        bool $isFlash = null
    ) {
        v::arrayType()->each(v::regex('/^09\d{9}$/'))->assert($receivers);
        $senderId ? v::intVal()->assert($senderId) : null;

        if ($isFlash != true) {
            $isFlash = null;
        }

        foreach ($receivers as $key => $value) {
            $receivers[$key] = preg_replace('/^0/', '98', $value);
        }

        $receivers = implode(",", $receivers);

        $data = array(
            'SmsText' => $smsText,
            'Receivers' => $receivers,
            'SenderId' => $senderId,
            'IsFlash' => $isFlash,
            'UDH' => $udh,
        );

        $body = $this->request('/Messages/Send', $data);

        $response = json_decode($body, true);

        if ($response['IsSuccessful'] == 1 and $response['StatusCode'] == 0) {
            return $response['BatchId'];
        } else {
            throw new AsiasmsException($response['StatusCode'] ?? 13);
        }
    }

    /**
     * Get messages in panel
     *
     * @param string $date (required)
     * @param string $receiver = '' (optional)
     * @return mixed
     * @throws AsiasmsException
     * @throws ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMessages(string $date, string $receiver = '')
    {
        v::date()->assert($date);
        v::stringType()->assert($receiver);

        $data = [
            'Date' => date('Ymd', strtotime($date)),
            'Receiver' => $receiver,
        ];

        $body = $this->request('Receive/GetMessage', $data);

        $response = json_decode($body, true);

        if ($response['IsSuccessful'] == 1 and $response['StatusCode'] == 0) {
            return $response['ReceivedMessages'];
        } else {
            throw new AsiasmsException($response['StatusCode'] ?? 13);
        }
    }

    /**
     * Get messages between two dates
     *
     * @param string $startDate (required)
     * @param string $endDate (required)
     * @param string $receiver = '' (optional)
     * @return mixed
     * @throws AsiasmsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMessagesBetweenDate(string $startDate, string $endDate, string $receiver = '')
    {
        v::date()->assert($startDate);
        v::date()->assert($endDate);
        v::stringType()->assert($receiver);

        $data = [
            'BeginDate' => date('Y-m-d', strtotime($startDate)),
            'EndDate' => date('Y-m-d', strtotime($endDate)),
            'Receiver' => $receiver,
        ];

        $body = $this->request('Receive/GetReceivedMessages', $data);

        $response = json_decode($body, true);

        if ($response['IsSuccessful'] == 1 and $response['StatusCode'] == 0) {
            return $response['ReceivedMessages'];
        } else {
            throw new AsiasmsException($response['StatusCode'] ?? 13);
        }
    }

    /**
     * Get panel Credit count
     *
     * @return mixed
     * @throws AsiasmsException
     * @throws RequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCredit()
    {
        $body = $this->request('/Messages/GetCredit');
        $response = json_decode($body, true);
        if ($response['IsSuccessful'] == 1 and $response['StatusCode'] == 0) {
            return $response['Credit'];
        } else {
            throw new AsiasmsException($response['StatusCode'] ?? 13);
        }
    }

    /**
     * Just for test guzzle http mock
     *
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }
}
