<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HistoricoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('historicos')->insert([
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 1
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 1
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 1
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 1
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 1
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 2
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 2
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 3
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 4
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 4
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 4
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 4
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 4
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 5
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 5
            ],
            [
                "created_at" => Carbon::now(),
                "descricao" => "Lorem ipsum dolor sit amet",
                "idAtividade" => 5
            ],
        ]);
    }
}
