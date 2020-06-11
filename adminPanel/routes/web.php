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
//Route::get("/", function() { return Redirect::to("deneme.php"); });
Route::get("katsil", function() { return Redirect::to("kat_sil.php"); });
//Route::view('/', 'welcome');
Route::get('adminPanel','Backend\adminPanel@index')->name('adminPanel');
Route::get('admin','Backend\adminLogin@index');
Route::post('admin','Backend\adminLogin@login')->name('adminLogin');
Route::get('adminpanel','Backend\postSilController@showPosts');
Route::get('adminpanel/postsil','Backend\postSilController@showPosts');
Route::post('adminpanel/postsil','Backend\postSilController@deletePost')->name('postsil');
Route::get('adminpanel/kategorionayla','Backend\kategoriOnaylaController@showCategories');
Route::post('adminpanel/kategorionayla','Backend\kategoriOnaylaController@confirmCat')->name('kategoriOnayla');
Route::get('adminpanel/kullaniciengelle','Backend\kullaniciEngelleController@index');
Route::post('adminpanel/kullaniciengelle','Backend\kullaniciEngelleController@showUser')->name('kgetir');
Route::post('adminpanel/kullaniciengellee','Backend\kullaniciEngelleController@deleteUser')->name('kullaniciEngelle');
Route::get('product','deneme@index');
Route::group(['prefix' => 'admin'], function() {


});
