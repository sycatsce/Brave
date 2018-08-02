<?php

namespace App\Characters\Twig;

use App\Characters\Repository\CharactersRepository;

class TwigCharacterExtension extends \Twig_Extension
{
    
    public function __construct(CharactersRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getVersion', [$this, 'getVersion']),
            new \Twig_SimpleFunction('getStats', [$this, 'getStats']),
            new \Twig_SimpleFunction('getAffiliation', [$this, 'getAffiliation']),
            new \Twig_SimpleFunction('getKiller', [$this, 'getKiller']),
            new \Twig_SimpleFunction('getSoulTrait', [$this, 'getSoulTrait']),
            new \Twig_SimpleFunction('getAttribute', [$this, 'getAttribute']),

            new \Twig_SimpleFunction('getDatas', [$this, 'getDatas']),
        ];
    }

    public function getVersion($characterId)
    {
        return $this->characterRepository->getVersion($characterId) . ' ver.';
    }

    public function getStats($characterId)
    {
        return $this->characterRepository->getStats($characterId);
    }

    public function getAffiliation($characterId, $affiliationNb = 1)
    {
        return $this->characterRepository->getAffiliation($characterId, $affiliationNb);
    }

    public function getKiller($characterId, $killerNb = 1)
    {
        return $this->characterRepository->getKiller($characterId, $killerNb);
    }

    public function getSoulTrait($characterId)
    {
        return $this->characterRepository->getSoulTrait($characterId);
    }

    public function getAttribute($characterId)
    {
        return $this->characterRepository->getAttribute($characterId);
    }
    
    public function getDatas(string $data)
    {
        return $this->characterRepository->getDatas($data);
    }
}
