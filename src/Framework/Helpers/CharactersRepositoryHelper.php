<?php

namespace Framework\Helpers;

trait CharactersRepositoryHelper
{
    public function getDatas(string $data)
    {
        switch($data){
            case 'versions':
                return $this->getVersions();
                break;
            case 'affiliations':
                return $this->getAffiliations();
                break;
            case 'soultraits':
                return $this->getSoulTraits();
                break;
            case 'killers':
                return $this->getKillers();
                break;
            case 'attributes':
                return $this->getAttributes();
                break;
        }
    }
}
