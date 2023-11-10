<?php

use App\Http\Controllers\ProfileController;
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
Route::get('/auth/{provider}/redirect', function (string $provider) {
    return Socialite::driver($provider)->redirect();
});
 
Route::get('/auth/{provider}/callback', function (string $provider) {
    $providerUser = Socialite::driver($provider)->user();

    $user = User::updateOrCreate([
        'email' => $providerUser->email,
    ], [
        'provider_id' => $providerUser->id,
        'name' => $providerUser->name,
        'email' => $providerUser->email,
        'provider_avatar' => $providerUser->avatar,
        'provider_name' => $provider
    ]);

    Auth::login($user);

    return redirect('/dashboard');
 
    // $user->token
})->name('auth.social.callback');

Route::middleware('admin')->group(function () {
    Route::get('/adminDashboard', function() {
        return 'Only admins can see that';
    })->name('admin.dashboard');
});

Route::get('/socialite', function () {
    return view('sample');
});

require __DIR__.'/auth.php';
