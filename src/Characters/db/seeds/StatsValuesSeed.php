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
        ];

        $posts = $this->table('statsvalues');
        $posts->insert($data)
              ->save();
    }
}
