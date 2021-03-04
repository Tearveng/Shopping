<?php

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

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\Blog\PostsController;
use App\Http\Controllers\Blog\AdminController;

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('blog/posts/{post}', [PostsController::class, 'show'])->name('blog.show');

Route::get('blog/categories/{category}', [PostsController::class, 'category'])->name('blog.category');

Route::get('blog/tags/{tag}', [PostsController::class, 'tag'])->name('blog.tag');



Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::resource('carts', 'CartsController');

});

Route::middleware(['auth', 'verifyIsAdmin'])->group(function () {

    Route::resource('categories', 'CategoriesController');

    Route::resource('posts', 'PostsController')->middleware(['auth']);

    Route::resource('tags', 'TagsController');

    Route::resource('options', 'OptionsController');

    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

    Route::put('restore-post/{post}', 'PostsController@restore')->name('restore.posts');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');

    Route::PUT('users/profile', 'UsersController@update')->name('users.update-profile');

    Route::get('users', 'UsersController@index')->name('users.index');

    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');

    Route::get('albums/create', [AlbumsController::class, 'create'])->name('albums.create');

    Route::post('albums', [AlbumsController::class, 'store'])->name('albums.store');

    Route::get('albums', [AlbumsController::class, 'index'])->name('albums.index');

    Route::resource('photos', 'PhotosController');

    Route::get('photos/create/{album}', 'PhotosController@create_photo')->name('photos.create');

    Route::get('albums/{album}', 'AlbumsController@show')->name('albums.show');

    Route::get('albums/{album}/edit', 'AlbumsController@edit')->name('albums.edit');

    Route::put('albums/{album}', 'AlbumsController@update')->name('albums.update');

    Route::delete('albums/{album}', 'AlbumsController@destroy')->name('albums.destroy');

    Route::get('cartsAdmin', [AdminController::class, 'index'])->name('admin.carts');
});
