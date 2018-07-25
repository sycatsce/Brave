<?php


use Phinx\Seed\AbstractSeed;

class KillersSeed extends AbstractSeed
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
            [ "id" => 1, "name" => "Soul Reaper", "value" => "20%" ],
            [ "id" => 2, "name" => "Arrancar", "value" => "20%"],
            [ "id" => 3, "name" => "Hollow", "value" => "20%"],
            [ "id" => 4, "name" => "Captain", "value" => "40%"],
            [ "id" => 5, "name" => "Espada", "value" => "40%"],
            [ "id" => 6, "name" => "None", "value" => "20%"]
        ];

        $posts = $this->table('killers');
        $posts->insert($data)
            ->save();
    }
}
