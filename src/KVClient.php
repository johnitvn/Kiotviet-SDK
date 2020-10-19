<?php


namespace KVSDK;


class KVClient
{

    /**
     * @var Config 
     */
    protected $config;

    /**
     * @var
     */
    protected $accessToken;

    
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
     * @param $url
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws \Exception
     */
    public function get($url, array $params)
    {
        return $this->client->doRequest('GET', $url, $params, $accessToken, $retailer);
    }

    /**
     * @param $url
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws \Exception
     */
    public function post($url, array $params)
    {
        return $this->client->doRequest('POST', $url, $params, $accessToken, $retailer);
    }

    /**
     * @param $url
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws \Exception
     */
    public function put($url, array $params)
    {
        return $this->client->doRequest('PUT', $url, $params, $accessToken, $retailer);
    }

    /**
     * @param $url
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     * @throws \Exception
     */
    public function delete($url, array $params)
    {
        return $this->client->doRequest('DELETE', $url, $params, $accessToken, $retailer);
    }

    /**
     * @param $method
     * @param $url
     * @param array $params
     * @param $accessToken
     * @param $retailer
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     */
    public function request($method, $url, array $params)
    {
        return $this->client->doRequest($method, $url, $params, $accessToken, $retailer, [], 'json');
    }



}