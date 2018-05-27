<?php

namespace GithubTest\Shell;

use Cake\Console\Shell;
use GithubTest\Lib\Entity\LanguageEntity;
use GithubTest\Lib\Entity\RepositoryEntity;
use GithubTest\Lib\Request\LanguageRequest;
use GithubTest\Lib\Request\RepositoryRequest;
use GithubTest\Lib\Security\Session;

class GetLanguageShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
    }

    function main()
    {
        $repositoryEntity = new RepositoryEntity();

        $repositoryRequest = new RepositoryRequest();
        $repositoryRequest->setEntity($repositoryEntity->structureBody());

        $repositorySession = new Session();
        $repositorySession->setRequest($repositoryRequest);
        $languagesRepos = $repositorySession->sendRequest();

        $languagesArray = [];

        foreach($languagesRepos as $languagesRepo)
        {
            $languageEntity = new LanguageEntity();

            $languageRequest = new LanguageRequest();
            $languageRequest->setCallName(str_replace($repositorySession::ENDPOINT_LIVE,'',$languagesRepo->languages_url));
            $languageRequest->setEntity($languageEntity->structureBody());

            $languageSession = new Session();
            $languageSession->setRequest($languageRequest);
            $languages = $languageSession->sendRequest();

            foreach ($languages as $key => $language)
            {
                array_push($languagesArray, $key);
            }

        }
        debug(array_unique($languagesArray));
    }
}