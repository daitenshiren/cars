<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Make as MakeModel;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $make = MakeModel::where('make', 'ford')->select('id')->first();

        $now = new \DateTime();
        $json = File::get("database/data/model.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
          DB::table('model')->insert([
            'model' => $obj->model,
            'make_id' => $make->id,
            'created_at' => $now
          ]);
        }
    }
}
