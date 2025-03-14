<?php


use App\Http\Controllers\FollowerController;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

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

Route::get('/', Homecontroller::class)->name('home');

// Rutas para el controlador Register
Route::get('/crear-cuenta',[RegisterController::class, 'index'])->name('register');
Route::post('/crear-cuenta',[RegisterController::class, 'store']); 

//Rutas para el perfil
Route::get('/editar-perfil',[PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil',[PerfilController::class, 'store'])->name('perfil.store');

// Ruta para el controlador login y logout
Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);
Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

// Ruta para el controlador para los POSTS = publicaciones
Route::get('/{user:username}',[PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');
Route::post('/posts',[PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');


Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

// Ruta para el controlador de imagenController
Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');


// Ruta para los likes de los posts
Route::post('/posts/{post}/Likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/Likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');


// Ruta para la funcionalidad de seguidores
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');

Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');