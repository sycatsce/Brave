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
            'VersionsSeed',
            'KillersSeed'
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
                "image" => "dangai_ichigo.png",
                "id_version" => 10,
                "id_attribute" => 1,
                "id_affiliation" => 1,
                "id_affiliation2" => null,
                "id_soultrait" => 1,
                "id_killer" => 5,
                "id_killer2" => null,
                "description" => "After being stabbed by Zangetsu's blade, Ichigo attains a power far superior to any other, but it comes at a terrible cost.",
                "release_date" => date('2016-09-30'),
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "id" => 2,
                "name" => "Yin&Yang",
                "nickname" => "y&n",
                "image" => "yin_yang.png",
                "id_version" => 4,
                "id_attribute" => 2,
                "id_affiliation" => 7,
                "id_affiliation2" => null,
                "id_soultrait" => 1,
                "id_killer" => 1,
                "id_killer2" => null,
                "description" => "Twins who take orders from Sojiro Kusaka. The girl with the blue hair is Yin and the redhead is Yang. They stand in Ichigo and his friends' way when they try to follow Toshiro.",
                "release_date" => date('2018-03-15'),
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "id" => 3,
                "name" => "Kusaka",
                "nickname" => "retsu counter (lol)",
                "image" => "retsu_counter.png",
                "id_version" => 4,
                "id_attribute" => 5,
                "id_affiliation" => 1,
                "id_affiliation2" => null,
                "id_soultrait" => 4,
                "id_killer" => 4,
                "id_killer2" => null,
                "description" => "Kusaka usually wears a cloak and hides his face behind a mask. Though he was the ringleader of the group that stole the Soul Society's sacred 'Ouin' treasure, he was originally a student at the Soul Reaper Academy at the same time as Toshiro, where he studied diligently to become a Soul Reaper. ",
                "release_date" => date('2018-03-15'),
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "id" => 4,
                "name" => "Toshiro",
                "nickname" => "fb toshiro",
                "image" => "fb_toshiro.png",
                "id_version" => 1,
                "id_attribute" => 4,
                "id_affiliation" => 1,
                "id_affiliation2" => null,
                "id_soultrait" => 2,
                "id_killer" => 2,
                "id_killer2" => null,
                "description" => "Captain of Squad 10. Toshiro's constant training after the battle with Aizen means he appears even stronger than before when Ichigo finally meets him again.",
                "release_date" => date('2016-03-30'),
                "created_at" => date('Y-m-d H:i:s'),
            ],
            [
                "id" => 5,
                "name" => "Tensa Zangetsu",
                "nickname" => "tensa",
                "image" => "tensa.png",
                "id_version" => null,
                "id_attribute" => 3,
                "id_affiliation" => 1,
                "id_affiliation2" => null,
                "id_soultrait" => 3,
                "id_killer" => 1,
                "id_killer2" => null,
                "description" => "Zangetsu's form when Ichigo enters his inner world in his Bankai state. For some reason, he continually refused to teach Ichigo the Final Getsugatensho.",
                "release_date" => date('2017-12-30'),
                "created_at" => date('Y-m-d H:i:s'),
            ]

        ];

        $this->table('characters')
        ->insert($data)
        ->save();
    }
}
