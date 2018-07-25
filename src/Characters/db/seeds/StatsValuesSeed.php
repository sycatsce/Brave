<?php


use Phinx\Seed\AbstractSeed;

class StatsValuesSeed extends AbstractSeed
{

    public function getDependencies()
    {
        return [
            'StatsNamesSeed',
            'CharactersSeed'
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
                "id_charaStats" => 1,
                "id_statsNames" => 1,
                "value" => 740
            ],
            [
                "id_charaStats" => 1,
                "id_statsNames" => 2,
                "value" => 592
            ],
            [
                "id_charaStats" => 1,
                "id_statsNames" => 3,
                "value" => 351
            ],
            [
                "id_charaStats" => 1,
                "id_statsNames" => 4,
                "value" => 308
            ],
            [
                "id_charaStats" => 1,
                "id_statsNames" => 5,
                "value" => 1006
            ],
            [
                "id_charaStats" => 2,
                "id_statsNames" => 1,
                "value" => 762
            ],
            [
                "id_charaStats" => 2,
                "id_statsNames" => 2,
                "value" => 618
            ],
            [
                "id_charaStats" => 2,
                "id_statsNames" => 3,
                "value" => 352
            ],
            [
                "id_charaStats" => 2,
                "id_statsNames" => 4,
                "value" => 345
            ],
            [
                "id_charaStats" => 2,
                "id_statsNames" => 5,
                "value" => 1017
            ],
            [
                "id_charaStats" => 3,
                "id_statsNames" => 1,
                "value" => 748
            ],
            [
                "id_charaStats" => 3,
                "id_statsNames" => 2,
                "value" => 630
            ],
            [
                "id_charaStats" => 3,
                "id_statsNames" => 3,
                "value" => 367
            ],
            [
                "id_charaStats" => 3,
                "id_statsNames" => 4,
                "value" => 344
            ],
            [
                "id_charaStats" => 3,
                "id_statsNames" => 5,
                "value" => 1007
            ],
            [
                "id_charaStats" => 4,
                "id_statsNames" => 1,
                "value" => 630
            ],
            [
                "id_charaStats" => 4,
                "id_statsNames" => 2,
                "value" => 688
            ],
            [
                "id_charaStats" => 4,
                "id_statsNames" => 3,
                "value" => 347
            ],
            [
                "id_charaStats" => 4,
                "id_statsNames" => 4,
                "value" => 318
            ],
            [
                "id_charaStats" => 4,
                "id_statsNames" => 5,
                "value" => 989
            ],
            [
                "id_charaStats" => 5,
                "id_statsNames" => 1,
                "value" => 632
            ],
            [
                "id_charaStats" => 5,
                "id_statsNames" => 2,
                "value" => 728
            ],
            [
                "id_charaStats" => 5,
                "id_statsNames" => 3,
                "value" => 352
            ],
            [
                "id_charaStats" => 5,
                "id_statsNames" => 4,
                "value" => 330
            ],
            [
                "id_charaStats" => 5,
                "id_statsNames" => 5,
                "value" => 988
            ],
        ];

        $posts = $this->table('statsvalues');
        $posts->insert($data)
              ->save();
    }
}
