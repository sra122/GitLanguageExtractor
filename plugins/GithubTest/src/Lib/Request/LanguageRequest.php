<?php
namespace GithubTest\Lib\Request;
class LanguageRequest extends AbstractRequest
{
    private $languageUrl;

    public function setCallName($languageUrl)
    {
        $this->languageUrl = $languageUrl;
        return $this->languageUrl;
    }

    public function getCallName()
    {
        return $this->languageUrl;
    }
}