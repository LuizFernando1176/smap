<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
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
            $foto = Foto::where('legenda', 'LIKE', "%$keyword%")
                ->orWhere('foto', 'LIKE', "%$keyword%")
                ->orWhere('idHistorico', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $foto = Foto::latest()->paginate($perPage);
        }

        return view('foto.index', compact('foto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('foto.create');
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
        foreach ($request->file('foto') as $i => $foto) {
            $nomeFoto = time().$foto->getClientOriginalName();
            $foto->move(public_path().'/storage/historico/'.$request->idHistorico, $nomeFoto );
            //save in database
            $itens = Foto::create([
                'foto' => '/historico/'.$request->idHistorico.'/'.$nomeFoto ,
                'idHistorico' => $request->idHistorico,
                'legenda' => $request->legenda[$i]
            ]);
        }
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
        $foto = Foto::findOrFail($id);

        return view('foto.show', compact('foto'));
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
        $foto = Foto::findOrFail($id);

        return view('foto.edit', compact('foto'));
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
			'foto' => 'required',
			'idHistorico' => 'required'
		]);
        $requestData = $request->all();
        if ($request->hasFile('foto')) {
            $requestData['foto'] = $request->file('foto')
                ->store('uploads', 'public');
        }

        $foto = Foto::findOrFail($id);
        $foto->update($requestData);

        return redirect('foto')->with('flash_message', 'Foto updated!');
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
        Foto::destroy($id);
        echo "Foto removida com sucesso!";
        //return redirect('foto')->with('flash_message', 'Foto deleted!');
    }
}
