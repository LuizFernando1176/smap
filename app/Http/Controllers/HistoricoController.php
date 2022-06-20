<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Foto;
use App\Models\Historico;
use App\Models\Secretarium;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HistoricoController extends Controller
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
            $historico = Historico::where('descricao', 'LIKE', "%$keyword%")
                ->orWhere('idAtividade', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $historico = Historico::latest()->paginate($perPage);
        }

        foreach ($historico as $key => $h) {
            $h->idAtividade = Atividade::findOrFail($h->idAtividade)->nome;
        }

        return view('historico.index', compact('historico'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($idAtividade)
    {
        $atividade = Atividade::findOrFail($idAtividade);
        $acao = Acao::findOrFail($atividade->idAcao);
        $secretaria = Secretarium::findOrFail($acao->idSecretaria);
        return view('historico.create', ['idAtividade' => $idAtividade, 'atividade' => $atividade, 'acao' => $acao, 'secretaria' => $secretaria]);
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
			'descricao' => 'required',
			'idAtividade' => 'required'
		]);
        $requestData = $request->all();

        /*if ($request->hasFile('foto')) {
            $requestData['foto'] = $request->file('foto')
                ->store('uploads', 'public');
        }*/

        $historico = Historico::create($requestData);

        $fC = new FotoController();
        $request->idHistorico = $historico->id;

        $fC->store($request);

        $aC = new AtividadeController();

        return $aC->show($requestData['idAtividade']);
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
        $historico = Historico::findOrFail($id);
        $atividade = Atividade::findOrFail($historico->idAtividade);
        $acao = Acao::findOrFail($atividade->idAcao);
        $secretaria = Secretarium::findOrFail($acao->idSecretaria);

        return view('historico.show', compact('historico', 'atividade', 'acao', 'secretaria'));
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
        $historico = Historico::findOrFail($id);
        $atividade = Atividade::findOrFail($historico->idAtividade);
        $idAtividade = $historico->idAtividade;
        $acao = Acao::findOrFail($atividade->idAcao);
        $secretaria = Secretarium::findOrFail($acao->idSecretaria);
        $fotos = Foto::all()->where('idHistorico', '=', $id);

        return view('historico.edit', compact('historico', 'idAtividade', 'fotos', 'atividade', 'acao', 'secretaria'));
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
			'descricao' => 'required',
			'idAtividade' => 'required'
		]);
        $requestData = $request->all();
        /*if ($request->hasFile('foto')) {
            $requestData['foto'] = $request->file('foto')
                ->store('uploads', 'public');
        }*/

        $historico = Historico::findOrFail($id);
        $historico->update($requestData);

        $aC = new AtividadeController();
        return $aC->show($requestData['idAtividade']);
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
        $aC = new AtividadeController();
        $idAtividade = Historico::findOrFail($id)->idAtividade;
        Historico::destroy($id);

        return $aC->show($idAtividade);
    }
}
