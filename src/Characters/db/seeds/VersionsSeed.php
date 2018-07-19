<?php


use Phinx\Seed\AbstractSeed;

class VersionsSeed extends AbstractSeed
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
            [ "id" => 1, "name" => "The Lost Agent" ],
            [ "id" => 2, "name" => "Thousand-Year Blood War"],
            [ "id" => 3, "name" => "Movie 1"],
            [ "id" => 4, "name" => "Movie 2"],
            [ "id" => 5, "name" => "Movie 3"],
            [ "id" => 6, "name" => "Movie 4"],
            [ "id" => 7, "name" => "Swimsuit"],
            [ "id" => 8, "name" => "Tag Team"],
            [ "id" => 9, "name" => "The Past"],
            [ "id" => 10, "name" => "Final Getsugatensho"]
        ];

        $posts = $this->table('versions');
        $posts->insert($data)
              ->save();
    }
}
