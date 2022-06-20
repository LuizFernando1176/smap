<?php

namespace App\Http\Controllers;

use App\Models\Secretarium;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all();
        $user = User::all();

        foreach ($user as $use) {
            $use->idSecretaria = Secretarium::findOrFail($use->idSecretaria)->nome;
        }

        return view('user.index', compact('user','use'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->idSecretaria = Secretarium::findOrFail($user->idSecretaria)->nome;
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
    }

    public function perfil($id){

        if($id == Auth::user()->id || Auth::user()->nivel == 1){
        $id = $id;
        $user = User::findOrFail($id);
        $idSecretaria = $user->idSecretaria;  
        //dd($user);      
        $secretarias = DB::select('SELECT s.nome , s.responsavel ,s.sigla ,s.telefone,s.email  
        FROM users AS us INNER JOIN secretarias AS s ON 
        us.idSecretaria = s.id WHERE us.id = ?', [$idSecretaria]);


        
        return view('layouts.perfil',compact('user','secretarias'));
    }else{
        $secretarias = Secretarium::all();
        return view('home',compact('secretarias'));
    }
    }

    public function mudarSenha(Request $request,$id){
        
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password); 
        $user->save();
        $idSecretaria = Auth::user()->idSecretaria;
        $secretarias = DB::select('SELECT s.nome , s.responsavel ,s.sigla ,s.telefone,s.email  
        FROM users AS us INNER JOIN secretarias AS s ON 
        us.idSecretaria = s.id WHERE us.id = ?', [$idSecretaria]);
        
        

        return view('layouts.perfil',compact('user','secretarias'));
    }
}
