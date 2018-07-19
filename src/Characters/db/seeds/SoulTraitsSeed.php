<?php


use Phinx\Seed\AbstractSeed;

class SoulTraitsSeed extends AbstractSeed
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
            [ "id" => 1, "effet" => "20% Normal Attack Damage" ],
            [ "id" => 2, "effet" => "20% Strong Attack Damage"],
            [ "id" => 3, "effet" => "12% Strong Attack Recharge Time"],
            [ "id" => 4, "effet" => "-16% Damage Taken"],
            [ "id" => 5, "effet" => "25% Normal Attack Damage" ],
            [ "id" => 6, "effet" => "25% Strong Attack Damage"],
            [ "id" => 7, "effet" => "14% Strong Attack Recharge Time"],
            [ "id" => 8, "effet" => "-20% Damage Taken"],
        ];

        $posts = $this->table('soultraits');
        $posts->insert($data)
              ->save();
    }
}
