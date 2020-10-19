<?php

namespace KVSDK;


class Config
{
    protected $clientId;
    protected $clientSecret;
    protected $retailer;
    protected $tokenEndpoint;
    protected $baseUri;

    public function __construct($clientId, $clientSecret, $retailer, $baseUri = 'https://id.kiotviet.com', $tokenEndpoint = '/connect/token')
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->retailer = $retailer;
        $this->baseUri = $baseUri;
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

    public function getBaseUri()
    {
        return $this->baseUri;
    }

    public function getTokenEndpoint()
    {
        return $this->tokenEndpoint;
    }
}