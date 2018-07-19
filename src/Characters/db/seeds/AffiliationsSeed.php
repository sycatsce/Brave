<?php


use Phinx\Seed\AbstractSeed;

class AffiliationsSeed extends AbstractSeed
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
            [ "id" => 1, "name" => "Soul Reaper" ],
            [ "id" => 2,"name" => "Hollow" ],
            [ "id" => 3, "name" => "Arrancar" ],
            [ "id" => 4, "name" => "Human" ],
            [ "id" => 5, "name" => "Captain" ],
            [ "id" => 6, "name" => "Espada" ],
        ];

        $posts = $this->table('affiliations');
        $posts->insert($data)
              ->save();
    }
}
