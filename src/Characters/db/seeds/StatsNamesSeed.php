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
            [ "id" => 1, "name" => "Stamina" ],
            [ "id" => 2, "name" => "Attack" ],
            [ "id" => 3, "name" => "Defense" ],
            [ "id" => 4, "name" => "Spiritual Pressure" ],
            [ "id" => 5, "name" => "Focus" ],
        ];

        $posts = $this->table('statsnames');
        $posts->insert($data)
              ->save();
    }
}
