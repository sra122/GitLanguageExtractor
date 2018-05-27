<?php
namespace GithubTest\Lib\Request;
class AbstractRequest
{
    protected $scope = 'https://api.github.com';
    protected $requestMethod = 'get';
    private $entity;

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function getCallName()
    {
        return "/";
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;
        return $this->entity;
    }

    public function getRequestBody()
    {
        $result = $this->getEntity();
        return $result;
    }
}