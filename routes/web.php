<?php

use App\Http\Controllers\Admin\ScenarioController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Middleware\IsAdmin;
use App\Models\Tabletop;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/define-password', function() {
    return Inertia::render('Profile/DefinePassword');
})->middleware(['auth'])->name('define-password');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rota de autenticação usuários github
/*
  Abre a janela de autenticação do github no primeiro acesso,
  da segunda vez em diante, a autenticação é automática
  e o usuário é redirecionado.
 */
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);

Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback'])
->name('auth.social.callback');

//Rotas de controle de sistemas de jogo
Route::controller(SystemController::class)
    ->prefix('admin/sistemas-de-jogo')
    ->middleware('admin')
    ->name('admin.system.')->group(function() {
        
    Route::get('/', 'index')->name('index');
    Route::get('/criar', 'create')->name('create');
    Route::get('/{system}', 'show')->name('show');
    Route::get('/{system}/editar', 'edit')->name('edit');
    Route::get('/{system}/excluir', 'delete')->name('delete');
    
    Route::put('/{system}', 'update')->name('update');
    Route::post('/', 'store')->name('store');
    Route::delete('/{system}', 'destroy')->name('destroy');
});

Route::controller(ScenarioController::class)
    ->prefix('admin/cenarios-de-jogo')
    ->middleware('admin')
    ->name('admin.scenario.')->group(function() {
        
    Route::get('/', 'index')->name('index');
    Route::get('/criar', 'create')->name('create');
    Route::get('/{scenario}', 'show')->name('show');
    Route::get('/{scenario}/editar', 'edit')->name('edit');
    Route::get('/{scenario}/excluir', 'delete')->name('delete');

    Route::post('/', 'store')->name('store');
    Route::put('/{scenario}', 'update')->name('update');
    Route::delete('/{scenario}', 'destroy')->name('destroy');
});

require __DIR__.'/auth.php';
