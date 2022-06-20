<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secretarias = json_decode(file_get_contents(asset('json/Organograma.json')), true);
        DB::table('secretarias')->insert($secretarias);
        DB::table('secretarias')->where('id', '=', 1)->update(['idSecretariaPai' => null]);
    }
}
