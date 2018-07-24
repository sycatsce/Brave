<?php

namespace Framework\Helpers;

trait CharactersRepositoryHelper
{

    public function retrieveAttributes(array $character)
    {
        $attributes = [];
        $attributes['version'] = $this->getVersion($character['id']);
        $attributes['affiliation'] = $this->getAffiliation($character['id']);
        if ($character['id_affiliation2'] !== null){
            $attributes['affiliation2'] = $this->getAffiliation($character['id'], 2);
        }
        $attributes['soultrait'] = $this->getSoulTrait($character['id']);
        $attributes['attribute'] = $this->getAttribute($character['id']);

        return $attributes;

    }
}
