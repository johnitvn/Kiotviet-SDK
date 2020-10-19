<?php


namespace KVSDK;


class KVClient
{

    /**
     * @var Config 
     */
    protected $config;

    
    /**
     * @var HttpClient
     */
    protected $client;


    /**
     * KVClient constructor.
     * @param Config
     * @throws \Exception
     */
    public function __construct(Config $config)
    {    
        $this->config = $config;
        $this->client = new HttpClient($config);
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->client->getAccessToken();
    }

    /**
     * @param $endPoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws \Exception
     */
    public function get($endPoint, array $params)
    {
        return $this->client->doRequest('GET', $endPoint, $params);
    }

    /**
     * @param $endPoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws \Exception
     */
    public function post($endPoint, array $params)
    {
        return $this->client->doRequest('POST', $endPoint, $params);
    }

    /**
     * @param $endPoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws \Exception
     */
    public function put($endPoint, array $params)
    {
        return $this->client->doRequest('PUT', $endPoint, $params);
    }

    /**
     * @param $endPoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws \Exception
     */
    public function delete($endPoint, array $params)
    {
        return $this->client->doRequest('DELETE', $endPoint, $params);
    }

    /**
     * @param $method
     * @param $endPoint
     * @param array $params
     * @param $accessToken
     * @param $retailer
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     */
    public function request($method, $endPoint, array $params)
    {
        return $this->client->doRequest($method, $endPoint, $params [], 'json');
    }



}