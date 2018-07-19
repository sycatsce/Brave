<?php


use Phinx\Seed\AbstractSeed;

class GameplaysSeed extends AbstractSeed
{
    public function getDependencies()
    {
        return [
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
                "type" => "Raid",
                "videoLink" => "https://youtu.be/xkZtm0Ta6G4",
                "id_charaGameplays" => 1
            ],
        ];

        $posts = $this->table('gameplays');
        $posts->insert($data)
              ->save();
    }
}
