<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataSiswa;
use App\Models\User;
use Alert;

class DataSiswaController extends Controller
{
    public function index()
    {
    	$data = DataSiswa::with('user')->paginate(10);
        $user = User::get();

    	return view('siswa/data-siswa.index',compact('data','user'));
    }

    public function store(Request $request)
    {   
        if ($request->input('user_id') != null) {            
                     
         $data = [
                    'user_id'           => $request->input('user_id'),
                    'nama_depan'        => $request->input('nama_depan'),
                    'nama_belakang'     => $request->input('nama_belakang'),
                    'alamat'            => $request->input('alamat'),
                    'nama_wali_murid'   => $request->input('nama_wali_murid'),
                    'no_telp_wali_murid'=> $request->input('no_telp_wali_murid'),
                    'alamat_wali_mulid' => $request->input('alamat_wali_murid'),                  
                 ];

        }
        else {

            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('data-siswa.index');
        }
            DataSiswa::create($data, $request->all());

            alert()->success('');
            Alert::success('Data berhasil ditambah', 'Sukses');
            return redirect()->route('data-siswa.index');
    }

    public function update(Request $request,$id)
    {
        if ($request->input('user_id') != null) {            
                     
         $data = [
                    'user_id'           => $request->input('user_id2'),
                    'nama_depan'        => $request->input('nama_depan'),
                    'nama_belakang'     => $request->input('nama_belakang'),
                    'alamat'            => $request->input('alamat'),
                    'nama_wali_murid'   => $request->input('nama_wali_murid'),
                    'no_telp_wali_murid'=> $request->input('no_telp_wali_murid'),
                    'alamat_wali_mulid' => $request->input('alamat_wali_murid'),
                 ];
         }

        else {
            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('data-siswa.index');
        }

    	DataSiswa::find($id)->update($data, $request->all());

        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('data-siswa.index');
    }

    public function destroy($id)
    {   
        DataSiswa::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('data-siswa.index');
    }
}
