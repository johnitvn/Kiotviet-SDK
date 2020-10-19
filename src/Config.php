<?php

namespace KVSDK;


class Config
{
    protected $clientId;
    protected $clientSecret;
    protected $retailer;
    protected $tokenEndpoint;
    protected $baseTokenUri;
    protected $baseApiUri;

    public function __construct($clientId, $clientSecret, $retailer, $baseApiUri = 'https://public.kiotapi.com/', $baseTokenUri = 'https://id.kiotviet.vn', $tokenEndpoint = '/connect/token')
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->retailer = $retailer;
        $this->baseTokenUri = $baseTokenUri;
        $this->baseApiUri = $baseApiUri;
        $this->tokenEndpoint = $tokenEndpoint;
    }

    public function getClientID()
    {
        return $this->clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function getRetailer()
    {
        return $this->retailer;
    }

    public function getBaseTokenUri()
    {
        return $this->baseTokenUri;
    }

    public function getBaseApiUri()
    {
        return $this->baseApiUri;
    }

    public function getTokenEndpoint()
    {
        return $this->tokenEndpoint;
    }
}