<?php


use Phinx\Seed\AbstractSeed;

class AttributesSeed extends AbstractSeed
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
            [ "id" => 1, "attribute" => "Speed" ],
            [ "id" => 2, "attribute" => "Power"],
            [ "id" => 3, "attribute" => "Technique"],
            [ "id" => 4, "attribute" => "Heart"],
            [ "id" => 5, "attribute" => "Mind"]
        ];

        $posts = $this->table('attributes');
        $posts->insert($data)
              ->save();
    }
}
