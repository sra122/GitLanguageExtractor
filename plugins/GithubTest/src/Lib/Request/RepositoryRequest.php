<?php
namespace GithubTest\Lib\Request;
class RepositoryRequest extends AbstractRequest
{
    public function getCallName()
    {
        return "/user/repos";
    }
}