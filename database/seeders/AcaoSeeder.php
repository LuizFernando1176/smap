<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AcaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //['nome', 'percentual', 'prazo', 'exercicio', 'status', 'idSecretaria']
        DB::table('acaos')->insert([
            [
                'created_at' => Carbon::now(),
                'nome' => 'Reforma do balcão de atendimento',
                'percentual' => 57.5,
                'prazo' => Carbon::tomorrow(),
                'exercicio' => date('Y'),
                'status' => 'Em execução',
                'idSecretaria' => 2
            ],
            [
                'created_at' => Carbon::now(),
                'nome' => 'Programa Arrecadação nos Altos',
                'percentual' => 45.0,
                'prazo' => Carbon::tomorrow(),
                'exercicio' => date('Y'),
                'status' => 'Em execução',
                'idSecretaria' => 2
            ],
            [
                'created_at' => Carbon::now(),
                'nome' => 'Programa Olinda mais',
                'percentual' => 75.0,
                'prazo' => Carbon::tomorrow(),
                'exercicio' => date('Y'),
                'status' => 'Em execução',
                'idSecretaria' => 2
            ],
            [
                'created_at' => Carbon::now(),
                'nome' => 'Reforma da Av. Pres. Kennedy',
                'percentual' => 15.0,
                'prazo' => Carbon::tomorrow(),
                'exercicio' => date('Y'),
                'status' => 'Em execução',
                'idSecretaria' => 7
            ],

            [
                'created_at' => Carbon::now(),
                'nome' => 'Reforma da Av. Pres. Kennedy',
                'percentual' => 15.0,
                'prazo' => Carbon::tomorrow(),
                'exercicio' => date('Y'),
                'status' => 'Em execução',
                'idSecretaria' => 3
            ],
        ]);
    }
}
