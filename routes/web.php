<?php

use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\AcaoController;
use App\Mail\UsuarioCadastrado;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/teste', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('secretaria', 'App\Http\Controllers\SecretariaController');
Route::resource('acao', 'App\Http\Controllers\AcaoController');
Route::resource('historico', 'App\Http\Controllers\HistoricoController');
Route::resource('atividade', 'App\Http\Controllers\AtividadeController');
Route::resource('foto', 'App\Http\Controllers\FotoController');
Route::resource('user', 'App\Http\Controllers\UserController');

//perfil do usuario 

Route::get('perfil/{id}', [App\Http\Controllers\UserController::class, 'perfil'])->name('perfil');
Route::post('perfil/mudarSenha/{id}', [App\Http\Controllers\UserController::class, 'mudarSenha'])->name('mudarSenha');

//Especifica as ações de uma secretaria
Route::get('acoes/{id}', [App\Http\Controllers\AcaoController::class, 'acoes'])->name('acoes');

//Atividades de uma determinada Ação
Route::get('atividades/{id}', [App\Http\Controllers\AtividadeController::class, 'show'])->name('atividades');

//Criar e salvar uma atividade
Route::controller(AcaoController::class)->group(function(){
    Route::get('/acao/create/{idSecretaria}', 'create');
    Route::post('/acao/store', 'store');
});

//Criar e salvar uma atividade
Route::controller(AtividadeController::class)->group(function(){
    Route::get('/atividade/create/{idAcao}', 'create');
    Route::post('/atividade/store', 'store');
});

//Criar e salvar histórico
Route::controller(HistoricoController::class)->group(function(){
    Route::get('/historico/create/{idAtividade}', 'create');
    Route::post('/historico/store', 'store');
});

//Remove a foto de um histórico
Route::get('excluirFoto/{id}', [App\Http\Controllers\FotoController::class, 'destroy'])->name('excluirFoto');

//----------------------------------------------------------------------------------------------------------
//Reset de senha
//Formulário de requisição de alteração
Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('passwordRequest');

//Submete o formulário e envia o e-mail
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('passwordEmail');

//Formulário de reset de senha
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->middleware('guest')->name('passwordReset');

//Submetendo o formulário de reset de senha
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('passwordUpdate');
//------------------------------------------------------------------------
