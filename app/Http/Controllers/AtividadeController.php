<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Foto;
use App\Models\Historico;
use App\Models\Secretarium;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AtividadeController extends Controller
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
            $atividade = Atividade::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('percentual', 'LIKE', "%$keyword%")
                ->orWhere('prazo', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('responsavel', 'LIKE', "%$keyword%")
                ->orWhere('observacao', 'LIKE', "%$keyword%")
                ->orWhere('numeroPPA', 'LIKE', "%$keyword%")
                ->orWhere('pPA', 'LIKE', "%$keyword%")
                ->orWhere('idAcao', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $atividade = Atividade::latest()->paginate($perPage);
        }

        return view('atividade.index', compact('atividade'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($idAcao)
    {
        $acao = Acao::findOrFail($idAcao);
        $secretaria = Secretarium::findOrFail($acao->idSecretaria);
        $responsaveis = DB::table('users')->select('users.id', 'users.name', 'secretarias.sigla')
        ->join('secretarias', 'secretarias.id', '=', 'users.idSecretaria')
        ->where('secretarias.id', '=', $acao->idSecretaria)
        ->orWhere('secretarias.idSecretariaPai', '=', $acao->idSecretaria)
        ->get();

        return view('atividade.create', ['acao' => $acao, 'secretaria' => $secretaria, 'responsaveis' => $responsaveis]);
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
			'nome' => 'required',
			'prazo' => 'required',
			'pPA' => 'required',
			'numeroPPA' => 'required',
            'idAcao' => 'required'
		]);
        $requestData = $request->all();

        $atividade = Atividade::create($requestData);
        $atividade->responsavel = User::find($atividade->responsavel)->name;
        $acao = Acao::find($requestData['idAcao']);
        $secretaria = Secretarium::find($acao->idSecretaria);

        //Atualiza a porcentagem da ação mãe
        $aC = new AcaoController();
        $aC->autalizaPorcentagem($requestData['idAcao']);

        $atePrazo = Carbon::createFromDate($requestData['prazo'])->diffForHumans();

        return view('atividade.show', compact('secretaria', 'acao', 'atividade', 'atePrazo'));
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
        $atividade = Atividade::findOrFail($id);
        $atividade->responsavel = User::findOrFail($atividade->responsavel)->name;
        $historicos = Historico::all()->where('idAtividade', '=', $id);
        $acao = Acao::findOrFail($atividade->idAcao);
        $secretaria = Secretarium::findOrFail($acao->idSecretaria);

        $fotos = [];

        foreach ($historicos as $i => $historico) {
            $fotos[$i] = Foto::all()->where('idHistorico', '=', $historico->id);
        }

        $atePrazo = Carbon::createFromDate($atividade->prazo)->diffForHumans();

        return view('atividade.show', compact('atividade', 'historicos', 'fotos', 'acao', 'secretaria', 'atePrazo'));
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
        $atividade = Atividade::findOrFail($id);
        $acao = Acao::findOrFail($atividade->id);
        $secretaria = Secretarium::findOrFail($acao->idSecretaria);
        $responsaveis = DB::table('users')->select('users.id', 'users.name', 'secretarias.sigla')
        ->join('secretarias', 'secretarias.id', '=', 'users.idSecretaria')
        ->where('secretarias.id', '=', $acao->idSecretaria)
        ->orWhere('secretarias.idSecretariaPai', '=', $acao->idSecretaria)
        ->get();

        return view('atividade.edit', compact('atividade', 'secretaria', 'acao', 'responsaveis'));
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
			'nome' => 'required',
			'prazo' => 'required',
			'pPA' => 'required',
			'numeroPPA' => 'required',
            'idAcao' => 'required'
		]);
        $requestData = $request->all();

        $atividade = Atividade::findOrFail($id);
        $atividade->update($requestData);

        $acao = Acao::find($requestData['idAcao']);
        $secretaria = Secretarium::find($acao->idSecretaria);
        $atePrazo = Carbon::createFromDate($requestData['prazo'])->diffForHumans();

        //Atualiza a porcentagem da ação mãe
        $aC = new AcaoController();
        $aC->autalizaPorcentagem($requestData['idAcao']);

        return view('atividade.show', compact('secretaria', 'acao', 'atividade', 'atePrazo'));
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
        Atividade::destroy($id);

        return redirect('atividade')->with('flash_message', 'Atividade deleted!');
    }
}
