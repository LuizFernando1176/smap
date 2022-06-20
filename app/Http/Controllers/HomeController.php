<?php

namespace App\Http\Controllers;

use App\Models\Secretarium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // SELECT * FROM secretarias as sec1 INNER JOIN secretarias as sec2 ON sec1.id = sec2.idSecretariaPai;
        $secretarias = Secretarium::all()->where('idSecretariaPai', '=', '1');

        $nomeSecretariasFilhas = array();

        foreach ($secretarias as $secretaria) {
            $nomeSecretariasFilhas[$secretaria->id] = Secretarium::all()->where('idSecretariaPai', '=', $secretaria->id);
        }

        return view('home', compact('secretarias', 'nomeSecretariasFilhas'));
    }
}
