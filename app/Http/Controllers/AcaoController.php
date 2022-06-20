<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Secretarium;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AcaoController extends Controller
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
            $acao = Acao::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('percentual', 'LIKE', "%$keyword%")
                ->orWhere('prazo', 'LIKE', "%$keyword%")
                ->orWhere('exercicio', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('idSecretaria', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $acao = Acao::latest()->paginate($perPage);
        }

        return view('acao.index', compact('acao'));
    }

    /**
     * Lista as ações de uma secretaria
     *
     * @return \Illuminate\View\View
     */
    public function acoes($id)
    {
        $perPage = 25;

        $acao = Acao::where('idSecretaria', '=', "$id")
            ->latest()->paginate($perPage);
        $total['execucao'] = Acao::where('idSecretaria', '=', "$id")
            ->where('status', 'LIKE', 'Em execução')
            ->count();

        $total['paralizada'] = Acao::where('idSecretaria', '=', "$id")
            ->where('status', 'LIKE', 'Paralizada')
            ->count();

        $total['concluida'] = Acao::where('idSecretaria', '=', "$id")
            ->where('status', 'LIKE', 'Comcluída')
            ->count();

        $secretaria = Secretarium::find($id)->nome;

        return view('acao.index', compact('acao', 'total', 'secretaria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($idSecretaria)
    {
        //$secretarias = Secretarium::all();
        $secretaria = Secretarium::findOrFail($idSecretaria);
        return view('acao.create', ['secretaria' => $secretaria]);
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
            'exercicio' => 'required'
        ]);
        $requestData = $request->all();

        $acao = Acao::create($requestData);
        $secretaria = Secretarium::find($acao->idSecretaria);
        $atePrazo = Carbon::createFromDate($acao->prazo)->diffForHumans();

        return view('acao.show', compact('acao', 'secretaria', 'atePrazo'));
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

        $acao = Acao::findOrFail($id);
        $secretaria = Secretarium::findOrFail($acao->idSecretaria);
        $atividades = DB::table('atividades as atv')->select('atv.*', 'ac.nome as nomeAcao')
            ->join('acaos as ac', 'atv.idAcao', '=', 'ac.id')
            ->where('ac.id', '=', $id)->get()->toArray();

        $atePrazo = Carbon::createFromDate($acao->prazo)->diffForHumans();

        return view('acao.show', compact('acao', 'atividades', 'secretaria', 'atePrazo'));
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
        $acao = Acao::findOrFail($id);
        $secretarias = Secretarium::all();
        $secretaria = Secretarium::findOrFail($acao->id);

        return view('acao.edit', compact('acao', 'secretarias', 'secretaria'));
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
            'exercicio' => 'required'
        ]);
        $requestData = $request->all();

        $acao = Acao::findOrFail($id);
        $acao->update($requestData);

        $secretaria = Secretarium::find($acao->idSecretaria);
        $atePrazo = Carbon::createFromDate($acao->prazo)->diffForHumans();

        return view('acao.show', compact('acao', 'secretaria', 'atePrazo'));
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
        $idSecretaria = Acao::find($id)->idSecretaria;
        Acao::destroy($id);
        $sC = new SecretariaController();

        return $sC->show($idSecretaria);
    }

    /**
     * Atualiza o percentil das ações
     */
    public function autalizaPorcentagem($id)
    {
        $atividades = Atividade::all()->where('idAcao', '=', $id);
        $soma = 0;
        foreach ($atividades as $atividade) {
            $soma += $atividade->percentual;
        }
        $media = ($soma / $atividades->count());

        $acao = Acao::findOrFail($id);
        $acao->percentual = $media;
        $acao->update();
    }
}
