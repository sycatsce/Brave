<?php


use Phinx\Seed\AbstractSeed;
use Faker\Factory;
use Faker\Provider\zh_TW\DateTime;

class CharactersSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'AffiliationsSeed',
            'AttributesSeed',
            'SoulTraitsSeed',
            'VersionsSeed'
        ];
    }

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                "id" => 1,
                "name" => "Ichigo",
                "nickname" => "Dangai Ichigo",
                "image" => "",
                "id_version" => 10,
                "id_attribute" => 1,
                "id_affiliation" => 1,
                "id_affiliation2" => null,
                "id_soultrait" => 1,
                "description" => "After being stabbed by Zangetsu's blade, Ichigo attains a power far superior to any other, but it comes at a terrible cost",
                "release_date" => date('2016-09-30'),
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "id" => 2,
                "name" => "Aizen",
                "nickname" => "hAizen",
                "image" => "",
                "id_version" => 11,
                "id_attribute" => 3,
                "id_affiliation" => 1,
                "id_affiliation2" => 2,
                "id_soultrait" => 3,
                "description" => "Ancien capitaine de la 5e division. Après avoir soumis le Hôgyoku, il a acquit une force transcendantale. Il est prêt à raser la ville de Karakura pour réaliser son plan de remplacer le roi spirituel et créer un nouveau monde.",
                "release_date" => date('2016-09-30'),
                "created_at" => date('Y-m-d H:i:s'),
            ]

        ];

        $this->table('characters')
        ->insert($data)
        ->save();
    }
}
