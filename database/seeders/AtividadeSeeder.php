<?php

namespace Database\Seeders;

use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AtividadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //['nome', 'percentual', 'prazo', 'status', 'responsavel', 'observacao', 'numeroPPA', 'pPA', 'idAcao', 'idSecretaria']
        DB::table('atividades')->insert([
            [
                'created_at' => Carbon::now(),
                'nome' => 'Teste 1',
                'percentual' => 100.0,
                'prazo' => Carbon::now(),
                'status' => 'Concluída',
                'responsavel' => 1,
                'observacao' => '',
                'numeroPPA' => 0,
                'pPA' => false,
                'idAcao' => 1
            ],
            [
                'created_at' => Carbon::now(),
                'nome' => 'Teste 2',
                'percentual' => 15.0,
                'prazo' => Carbon::now(),
                'status' => 'Em execução',
                'responsavel' => 2,
                'observacao' => '',
                'numeroPPA' => 2000,
                'pPA' => true,
                'idAcao' => 1
            ],
            [
                'created_at' => Carbon::now(),
                'nome' => 'Teste 3',
                'percentual' => 40.0,
                'prazo' => Carbon::now(),
                'status' => 'Em execução',
                'responsavel' => 1,
                'observacao' => '',
                'numeroPPA' => 0,
                'pPA' => false,
                'idAcao' => 2
            ],
            [
                'created_at' => Carbon::now(),
                'nome' => 'Teste 4',
                'percentual' => 100.0,
                'prazo' => Carbon::now(),
                'status' => 'Concluída',
                'responsavel' => 3,
                'observacao' => '',
                'numeroPPA' => 0,
                'pPA' => false,
                'idAcao' => 4
            ],
            [
                'created_at' => Carbon::now(),
                'nome' => 'Teste 5',
                'percentual' => 0.0,
                'prazo' => Carbon::now(),
                'status' => 'Paralizada',
                'responsavel' => 5,
                'observacao' => '',
                'numeroPPA' => 2000,
                'pPA' => true,
                'idAcao' => 4
            ],
            [
                'created_at' => Carbon::now(),
                'nome' => 'Teste 6',
                'percentual' => 85.0,
                'prazo' => Carbon::now(),
                'status' => 'Em execução',
                'responsavel' => 5,
                'observacao' => '',
                'numeroPPA' => 2000,
                'pPA' => true,
                'idAcao' => 5
            ],
            [
                'created_at' => Carbon::now(),
                'nome' => 'Teste 7',
                'percentual' => 0,
                'prazo' => Carbon::now(),
                'status' => 'Paralizada',
                'responsavel' => 8,
                'observacao' => '',
                'numeroPPA' => 0,
                'pPA' => false,
                'idAcao' => 5
            ]
        ]);
    }
}
