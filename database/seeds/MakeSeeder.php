<?php

use Illuminate\Database\Seeder;

class MakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new \DateTime();
        $json = File::get("database/data/make.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
          DB::table('make')->insert([
            'make' => $obj->make,
            'created_at' => $now
          ]);
        }
    }
}
