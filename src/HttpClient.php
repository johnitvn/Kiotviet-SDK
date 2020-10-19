<?php

namespace KVSDK;

use DateTime;
use DateInterval;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient
{

    protected $config;
    private static $accessToken;
    private static $expireAt;

    /**
     * Kiotviet constructor.
     * @param Config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param $method
     * @param $endPoint
     * @param $params
     * @param array $headers
     * @param string $bodyType
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     */
    public function doRequest($method, $endPoint, $params, $headers = [], $bodyType = '')
    {
        $client = new Client(['base_uri' => $this->config->getBaseUri()]);

        $options = [];

        $options['headers'] = [
            'Retailer' => $this->config->getRetailer(),
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
        ];

        if (sizeof($headers) > 0) {
            $options['headers'] = array_merge($options['headers'], $headers);
        }

        if ($method == 'GET') {
            $options['query'] = $params;
        } else {
            $options['form_params'] = $params;
        }

        if ($bodyType == 'json') {
            $options['json'] = $params;
            $options['headers']['Content-Type'] = 'application/json';
        }

        try {
            $response = $client->request($method, $endPoint, $options);
        } catch (GuzzleException $e) {
            return $this->responseError($e->getMessage(), 'Can not connect to Kiotviet: ' . $e->getMessage());
        }

        $response = $response->getBody()->getContents();
        $response = json_decode($response, true);

        return $this->responseSuccess($response);
    }

    public function responseSuccess($data)
    {
        return [
            'status' => 'success',
            'data' => $data,
            'message' => 'Done!',
        ];
    }

    public function responseError($errors, $message, $errorCode = "")
    {
        return [
            'status' => 'error',
            'data' => null,
            'error' => $errors,
            'errorCode' => $errorCode,
            'message' => $message,
        ];
    }

    /**
     * Get the KiotViet Public API Access Token
     */
    public function getAccessToken()
    {
        // Access Token is empty or expire or have only 10 seconds to expire
        // We will request for get accesss token
        if (empty(self::$accessToken) || self::$expireAt->diff(new DateTime("now"))->format('%s') > -10) {
            $this->requestForGetAccessToken();
        }
        return self::$accessToken;
    }

    /**
     * Request to KiotViet API to get new Access Token
     * @param \KVSDK\Config $config
     * @throws GuzzleException
     * @throws EmptyResponseException
     */
    private function requestForGetAccessToken()
    {
        $client = new Client(['base_uri' => $this->config->getBaseUri()]);
        $response = $client->request('POST',$this->config->getTokenEndpoint(), [
            'form_params' => [
                'client_id' => '209013e4-c2b0-40fd-ab21-9714b860b506',
                'client_secret' => '6DEB5226A30316692241D734BE533A368ECA69EA',
                'grant_type'=> 'client_credentials',
                'scopes' => 'PublicApi.Access'
            ]
        ]);
        
        $statusCode = $response->getStatusCode();
        $responseBody = $response->getBody();
        $responseDataArray = json_decode($responseBody,true);
    
        self::$accessToken = $responseDataArray['access_token'];
        self::$expireAt = new DateTime('now');
        self::$expireAt->add(new DateInterval('PT' . $responseDataArray['expires_in'] . 'S'));

    }

}
