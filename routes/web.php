<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Usuario\UsuarioController;

Route::get('/', function () {
    return view('home');
})->name('get.home');

Route::get('permissoes', [AdminController::class, 'showpermissions']
)->name('get.showpermissions');


Route::get('/admin', [AdminController::class, 'indexAdmin']
)->name('get.indexAdmin');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('upload', [AdminController::class, 'upload']
    )->name('get.upload');

    Route::post('upload', [AdminController::class, 'storeupload']
    )->name('post.upload');

    Route::get('editar', [AdminController::class, 'editar']
    )->name('get.editar');

    Route::put('editar', [AdminController::class, 'storeeditar']
    )->name('put.editar');

});


Route::middleware('auth')->prefix('usuarios')->group(function () {

    Route::get('/', [UsuarioController::class, 'show']
    )->name('user.get.principal');

    Route::get('/adicionar', [UsuarioController::class, 'adicionar']
    )->name('user.get.adicionar');
    Route::post('/adicionar', [UsuarioController::class, 'store']
    )->name('user.post.adicionar');

    Route::get('/editar/{id}', [UsuarioController::class, 'edit']
    )->name('user.get.editar');
    Route::put('/editar/{id}', [UsuarioController::class, 'update']
    )->name('user.put.editar');

    Route::get('/deletar/{id}', [UsuarioController::class, 'delete']
    )->name('user.get.deletar');
    Route::delete('/deletar/{id}', [UsuarioController::class, 'destroy']
    )->name('user.delete.deletar');

});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
