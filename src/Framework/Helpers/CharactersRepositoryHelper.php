<?php

namespace Framework\Helpers;

trait CharactersRepositoryHelper
{

    public function retrieveAttributes(array $character)
    {
        $attributes = [];
        $attributes['stats'] = $this->getStats($character['id']);
        if (!is_null($character['id_version'])){
            $attributes['version'] = $this->getVersion($character['id']);
        }
        $attributes['affiliation'] = $this->getAffiliation($character['id']);
        if ($character['id_affiliation2'] !== null){
            $attributes['affiliation2'] = $this->getAffiliation($character['id'], 2);
        }
        $attributes['soultrait'] = $this->getSoulTrait($character['id']);
        $attributes['attribute'] = $this->getAttribute($character['id']);
        $attributes['killer'] = $this->getKiller($character['id']);
        if ($character['id_killer2'] !== null){
            $attributes['killer2'] = $this->getKiller($character['id'], 2);
        }  
        return $attributes;

    }
}
