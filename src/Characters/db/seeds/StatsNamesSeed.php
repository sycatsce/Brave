<?php


use Phinx\Seed\AbstractSeed;

class StatsNamesSeed extends AbstractSeed
{
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
            [ "id" => 1, "name" => "Attack" ],
            [ "id" => 2, "name" => "Spiritual Pressure" ],
            [ "id" => 3, "name" => "Defense" ],
            [ "id" => 4, "name" => "Focus" ],
            [ "id" => 5, "name" => "Stamina" ],
        ];

        $posts = $this->table('statsnames');
        $posts->insert($data)
              ->save();
    }
}
