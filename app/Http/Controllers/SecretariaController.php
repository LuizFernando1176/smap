<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Secretarium;
use App\Models\User;
use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $secretaria = Secretarium::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('sigla', 'LIKE', "%$keyword%")
                ->orWhere('responsavel', 'LIKE', "%$keyword%")
                ->orWhere('idSecretariaPai', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $secretaria = Secretarium::latest()->paginate($perPage);
        }

        return view('secretaria.index', compact('secretaria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $secretarias = Secretarium::all()->sortBy('nome');
        return view('secretaria.create', ["secretarias" => $secretarias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'nome' => 'required|min:4',
			'sigla' => 'required'
		]);
        $requestData = $request->all();

        Secretarium::create($requestData);

        $hC = new HomeController();
        return $hC->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $usuarios = User::all()->where('idSecretaria', '=', $id);
        $secretaria = Secretarium::findOrFail($id);
        $secretariasFilhas = Secretarium::all()->where('idSecretariaPai', '=', $id);
        $secretariaMae = Secretarium::findOrFail($secretaria->idSecretariaPai);
        $acoes = Acao::all()->where('idSecretaria', '=', $id);
        $quantidadeAtividades = [];

        foreach ($acoes as $i => $acao){

            $quantidadeAtividades[$i] = Atividade::all()->where('idAcao','=',$acao->id)->count();
            
        }
     
        
        return view('secretaria.show', compact('secretaria', 'quantidadeAtividades','acoes', 'usuarios', 'secretariasFilhas', 'secretariaMae'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $secretarium = Secretarium::findOrFail($id);
        $secretarias = Secretarium::all()->sortBy('nome');

        return view('secretaria.edit', compact('secretarium', 'secretarias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'nome' => 'required|min:4',
			'sigla' => 'required'
		]);
        $requestData = $request->all();

        $secretarium = Secretarium::findOrFail($id);
        $secretarium->update($requestData);

        $hC = new HomeController();
        return $hC->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Secretarium::destroy($id);

        return redirect('home');
    }
}
