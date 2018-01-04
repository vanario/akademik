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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('penduduk', function () {
    return view('penduduk/index');
});

Route::get('detail', function () {
    return view('penduduk/detail');
});

Route::get('data-master', function () {
    return view('data-master/index');
});

// Route::resource('slider', 'Slider\SliderController', ['only' => [
//     'index', 'store', 'update', 'destroy'
// ]]);

Route::group(['prefix' => 'slider', 'middleware' => ['auth']], function() {

     Route::get('/','Master\SliderController@index')->name('slider.index');
     Route::post('store','Master\SliderController@store')->name('slider.store');
     Route::match(['put','patch'],'update/{id}','Master\SliderController@update')->name('slider.update');
     Route::get('delete/{id}', 'Master\SliderController@destroy')->name('slider.delete');
  });

Route::group(['prefix' => 'mapel', 'middleware' => ['auth']], function() {

     Route::get('/','Master\MapelController@index')->name('mapel.index');
     Route::post('store','Master\MapelController@store')->name('mapel.store');
     Route::match(['put','patch'],'update/{id}','Master\MapelController@update')->name('mapel.update');
     Route::get('delete/{id}', 'Master\MapelController@destroy')->name('mapel.delete');
  });

Route::group(['prefix' => 'kelas', 'middleware' => ['auth']], function() {

     Route::get('/','Master\KelasController@index')->name('kelas.index');
     Route::post('store','Master\KelasController@store')->name('kelas.store');
     Route::match(['put','patch'],'update/{id}','Master\KelasController@update')->name('kelas.update');
     Route::get('delete/{id}', 'Master\KelasController@destroy')->name('kelas.delete');
  });

Route::group(['prefix' => 'semester', 'middleware' => ['auth']], function() {

     Route::get('/','Master\SemesterController@index')->name('semester.index');
     Route::post('store','Master\SemesterController@store')->name('semester.store');
     Route::match(['put','patch'],'update/{id}','Master\SemesterController@update')->name('semester.update');
     Route::get('delete/{id}', 'Master\SemesterController@destroy')->name('semester.delete');
  });

Route::group(['prefix' => 'tahun-ajar', 'middleware' => ['auth']], function() {

     Route::get('/','Master\TahunAjarController@index')->name('tahun-ajar.index');
     Route::post('store','Master\TahunAjarController@store')->name('tahun-ajar.store');
     Route::match(['put','patch'],'update/{id}','Master\TahunAjarController@update')->name('tahun-ajar.update');
     Route::get('delete/{id}', 'Master\TahunAjarController@destroy')->name('tahun-ajar.delete');
  });
