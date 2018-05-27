<?php
namespace GithubTest\Lib\Security;

use Cake\Http\Client;

class Session
{
    const ENDPOINT_LIVE = "https://api.github.com";
    private $endpoint;
    private $client;
    private $request;
    private $username;
    private $requestHeader = [
        'Authorization' => 'token user_token'
    ];

    public function __construct()
    {
        $this->endpoint = self::ENDPOINT_LIVE;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this->request;
    }

    public function setHeaderValue($key, $value)
    {
        $this->requestHeader[$key] = $value;
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function getRequestHeader()
    {
        return $this->buildRequestHeader();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    private function buildRequestHeader()
    {
        return ['headers' => $this->requestHeader];
    }

    public function sendRequest()
    {
        $body = $this->getRequest();
        if (empty($this->client)) {
            $this->client = new Client();
        }

        $response = $this->client->{$body->getRequestMethod()}($this->getEndpoint(). $body->getCallName(), $body->getRequestBody(), $this->getRequestHeader());
        if (!empty($response)) {
            return json_decode($response->body);
        }
        debug($response);
        return false;
    }
}