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

Route::group(['prefix' => 'sms-gateway'], function() {
    Route::get('index', 'SmsGateway\SmsGatewayController@index')->name('sms-gateway.index');
    Route::match(['get','post'],'send', 'SmsGateway\SmsGatewayController@send');     
});

Route::group(['prefix' => 'kenaikan-kelas-siswa'], function() {
    Route::match(['get','post'], 'index', 'Siswa\SiswaHasKelasController@index')->name('siswa-has-kelas.index');
    Route::post('/create', 'Siswa\SiswaHasKelasController@store')->name('siswa-has-kelas.store');;
});

Route::group(['prefix' => 'data-guru', 'middleware' => ['web','level:1']], function() {

     Route::get('/','Guru\DataGuruController@index')->name('data-guru.index');
     Route::get('detail/{id}','Guru\DataGuruController@show')->name('data-guru.detail');
     Route::post('store','Guru\DataGuruController@store')->name('data-guru.store');
     Route::match(['put','patch'],'update/{id}','Guru\DataGuruController@update')->name('data-guru.update');
     Route::get('delete/{id}', 'Guru\DataGuruController@destroy')->name('data-guru.delete');
});

Route::group(['prefix' => 'pengampu', 'middleware' => ['web','level:1']], function() {

     Route::get('/','Guru\PengampuController@index')->name('pengampu.index');
     Route::post('store','Guru\PengampuController@store')->name('pengampu.store');
     Route::match(['put','patch'],'update/{id}','Guru\PengampuController@update')->name('pengampu.update');
     Route::get('delete/{id}', 'Guru\PengampuController@destroy')->name('pengampu.delete');
});

Route::group(['prefix' => 'jadwal', 'middleware' => ['web','level:1']], function() {

     Route::get('/','Jadwal\JadwalController@index')->name('jadwal.index');
     Route::post('store','Jadwal\JadwalController@store')->name('jadwal.store');
     Route::match(['put','patch'],'update/{id}','Jadwal\JadwalController@update')->name('jadwal.update');
     Route::get('delete/{id}', 'Jadwal\JadwalController@destroy')->name('jadwal.delete');
});

Route::group(['prefix' => 'wali-kelas', 'middleware' => ['web','level:1']], function() {

     Route::match(['get','post'],'/','Guru\WaliKelasController@index')->name('wali-kelas.index');
     Route::post('store','Guru\WaliKelasController@store')->name('wali-kelas.store');
     Route::match(['put','patch'],'update/{id}','Guru\WaliKelasController@update')->name('wali-kelas.update');
     Route::get('delete/{id}', 'Guru\WaliKelasController@destroy')->name('wali-kelas.delete');
});

Route::group(['prefix' => 'data-siswa', 'middleware' => ['web','level:1']], function() {

     Route::match(['get','post'],'/','Siswa\DataSiswaController@index')->name('data-siswa.index');
     Route::post('store','Siswa\DataSiswaController@store')->name('data-siswa.store');
     Route::match(['put','patch'],'update/{id}','Siswa\DataSiswaController@update')->name('data-siswa.update');
     Route::get('delete/{id}', 'Siswa\DataSiswaController@destroy')->name('data-siswa.delete');
  });

Route::group(['prefix' => 'nilai', 'middleware' => ['web','guru:3']], function() {

     Route::match(['get','post'],'/','Siswa\NilaiController@index')->name('nilai.index');
     Route::match(['get','post'],'pdfprint','Siswa\NilaiController@print')->name('nilai.pdfprint');
     Route::match(['get','post'],'pdf','Siswa\NilaiController@pdf')->name('nilai.pdf');
     Route::post('store','Siswa\NilaiController@store')->name('nilai.store');
     // Route::match(['put','patch'],'update/{id}','Siswa\NilaiController@update')->name('nilai.update');
     Route::post('update/{id}','Siswa\NilaiController@update')->name('nilai.update');
     Route::get('delete/{id}', 'Siswa\NilaiController@destroy')->name('nilai.delete');
});

Route::group(['prefix' => 'course', 'middleware' => ['web','level:1']], function() {
     Route::match(['get','post'],'/','Siswa\CourseController@index')->name('course.index');
     Route::post('store','Siswa\CourseController@store')->name('course.store');
});

Route::group(['prefix' => 'presensi', 'middleware' => ['web','level:1']], function() {

     Route::match(['get','post'],'/','Siswa\PresensiController@index')->name('presensi.index');
     Route::post('store','Siswa\PresensiController@store')->name('presensi.store');
     Route::match(['put','patch'],'update/{id}','Siswa\PresensiController@update')->name('presensi.update');
     Route::get('delete/{id}', 'Siswa\PresensiController@destroy')->name('presensi.delete');
  });

Route::group(['prefix' => 'ahlak', 'middleware' => ['web','level:1']], function() {

     Route::match(['get','post'],'/','Siswa\AhlakController@index')->name('ahlak.index');
     Route::post('store','Siswa\AhlakController@store')->name('ahlak.store');
     Route::match(['put','patch'],'update/{id}','Siswa\AhlakController@update')->name('ahlak.update');
     Route::get('delete/{id}', 'Siswa\AhlakController@destroy')->name('ahlak.delete');
  });

Route::group(['prefix' => 'ekstrak', 'middleware' => ['web','level:1']], function() {

     Route::match(['get','post'],'/','Siswa\EkstrakurikulerController@index')->name('ekstrak.index');
     Route::post('store','Siswa\EkstrakurikulerController@store')->name('ekstrak.store');
     Route::match(['put','patch'],'update/{id}','Siswa\EkstrakurikulerController@update')->name('ekstrak.update');
     Route::get('delete/{id}', 'Siswa\EkstrakurikulerController@destroy')->name('ekstrak.delete');
  });

Route::group(['prefix' => 'ref-ekstrakulikuler', 'middleware' => ['web','level:1']], function() {

     Route::match(['get','post'],'/','Master\RefEkstrakulikulerController@index')->name('refekstrakulikuler.index');
     Route::post('store','Master\RefEkstrakulikulerController@store')->name('refekstrakulikuler.store');
     Route::match(['put','patch'],'update/{id}','Master\RefEkstrakulikulerController@update')->name('refekstrakulikuler.update');
     Route::get('delete/{id}', 'Master\RefEkstrakulikulerController@destroy')->name('refekstrakulikuler.delete');
});

Route::get('data-master', function () {
    return view('data-master/index');
});

Route::group(['prefix' => 'slider', 'middleware' => ['web','level:1']], function() {

     Route::get('/','Master\SliderController@index')->name('slider.index');
     Route::post('store','Master\SliderController@store')->name('slider.store');
     Route::match(['put','patch'],'update/{id}','Master\SliderController@update')->name('slider.update');
     Route::get('delete/{id}', 'Master\SliderController@destroy')->name('slider.delete');
  });

Route::group(['prefix' => 'mapel', 'middleware' => ['web','level:1']], function() {

     Route::get('/','Master\MapelController@index')->name('mapel.index');
     Route::post('store','Master\MapelController@store')->name('mapel.store');
     Route::match(['put','patch'],'update/{id}','Master\MapelController@update')->name('mapel.update');
     Route::get('delete/{id}', 'Master\MapelController@destroy')->name('mapel.delete');
  });

Route::group(['prefix' => 'kelas', 'middleware' => ['web','level:1']], function() {

     Route::get('/','Master\KelasController@index')->name('kelas.index');
     Route::post('store','Master\KelasController@store')->name('kelas.store');
     Route::match(['put','patch'],'update/{id}','Master\KelasController@update')->name('kelas.update');
     Route::get('delete/{id}', 'Master\KelasController@destroy')->name('kelas.delete');
  });

Route::group(['prefix' => 'semester', 'middleware' => ['web','level:1']], function() {

     Route::get('/','Master\SemesterController@index')->name('semester.index');
     Route::post('store','Master\SemesterController@store')->name('semester.store');
     Route::match(['put','patch'],'update/{id}','Master\SemesterController@update')->name('semester.update');
     Route::get('delete/{id}', 'Master\SemesterController@destroy')->name('semester.delete');
  });

Route::group(['prefix' => 'tahun-ajar', 'middleware' => ['web','level:1']], function() {

     Route::get('/','Master\TahunAjarController@index')->name('tahun-ajar.index');
     Route::post('store','Master\TahunAjarController@store')->name('tahun-ajar.store');
     Route::match(['put','patch'],'update/{id}','Master\TahunAjarController@update')->name('tahun-ajar.update');
     Route::get('delete/{id}', 'Master\TahunAjarController@destroy')->name('tahun-ajar.delete');
  });

Route::group(['prefix' => 'register', 'middleware' => ['web','level:1']], function() {

     Route::get('index','RegisterUserController@index')->name('register.index');
     Route::post('store','RegisterUserController@create')->name('register.store');
     Route::match(['put','patch'],'update/{id}','RegisterUserController@update')->name('register.update');
     Route::get('delete/{id}', 'RegisterUserController@destroy')->name('register.delete');
  });

Route::group(['prefix' => 'wali-nilai', 'middleware' => ['web','guru:3']], function() {

     Route::match(['get','post'],'index','WaliKelas\WaliKelasController@index')->name('wali-nilai.index');     
     Route::match(['get','post'],'print','WaliKelas\WaliKelasController@print')->name('wali-nilai.print');        
     Route::match(['get','post'],'nilaipdf','WaliKelas\WaliKelasController@pdf')->name('wali-nilai.nilaipdf');    
  });

Route::group(['prefix' => 'nilai-siswa', 'middleware' => ['web','siswa:4']], function() {

     Route::get('index','NilaiSiswa\NilaiSiswaController@index')->name('nilai-siswa.index');     
  });


