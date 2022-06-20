<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Emmanuel Siqueira Leite',
                'email' => 'emmanuel.leite@olinda.pe.gov.br',
                'password' => Hash::make('emmanuel'),
                'cpf' => '0',
                'matricula'=> 11111,
                'nivel' => 1,
                'idSecretaria' => 4,
            ],
            [
                'name' => 'Demócrito dAnunciação',
                'email' => 'democrito@olinda.pe.gov.br',
                'password' => Hash::make('democrito'),
                'cpf'=> '1326859498',
                'matricula'=> 55555,
                'nivel'=> 3,
                'idSecretaria' => 4,
            ],
            [
                'name' => 'Luiz Fernando da Silva Ferreira',
                'email' => 'luiz.ferreira@olinda.pe.gov.br',
                'password' => Hash::make('luiz'),
                'cpf' => '0',
                'matricula'=> 22222,
                'nivel' => 2,
                'idSecretaria' => 4,
            ]
        ]);

        $usuarios = json_decode(file_get_contents(asset('json/usuarios.json')), true);
        $usuariosFormatados = [];

        foreach ($usuarios as $usuario) {
            $usuario['password'] = Hash::make($usuario['password']);
            $usuario['created_at'] = Carbon::now();
            array_push($usuariosFormatados, $usuario);
        }

        DB::table('users')->insert($usuariosFormatados);

    }
}
