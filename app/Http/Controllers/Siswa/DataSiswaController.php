<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataSiswa;
use App\Models\User;
use Alert;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {

         $query = DataSiswa::query();

            if($request->input('user_id')) {
                $query->where('nama_depan', $request->input('user_id'));
            }                      
            $data = $query->paginate(10);
        
        $user   = User::where('level',4)->get();

    	return view('siswa/data-siswa.index',compact('data','user','siswa'));
    }

    public function store(Request $request)
    {   
        if ($request->input('user_id') != null) {            
                     
         $data = [
                    'user_id'           => $request->input('user_id'),
                    'nama_depan'        => $request->input('nama_depan'),
                    'nis'               => $request->input('nis'),
                    'nisn'              => $request->input('nisn'),
                    'tempat_lahir'      => $request->input('tempat_lahir'),
                    'tanggal_lahir'     => $request->input('tanggal_lahir'),
                    'agama'             => $request->input('agama'),
                    'jenis_kelamin'     => $request->input('jenis_kelamin'),
                    'kelas'             => $request->input('kelas'),
                    'nama_ayah'         => $request->input('nama_ayah'),
                    'pekerjaan_ayah'    => $request->input('pekerjaan_ayah'),
                    'nama_ibu'          => $request->input('nama_ibu'),
                    'pekerjaan_ibu'     => $request->input('pekerjaan_ibu'),
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
                  
                     
         $data = [
                    'nama_depan'        => $request->input('nama_depan'),
                    'nis'               => $request->input('nis'),
                    'nisn'              => $request->input('nisn'),
                    'tempat_lahir'      => $request->input('tempat_lahir'),
                    'tanggal_lahir'     => $request->input('tanggal_lahir'),
                    'agama'             => $request->input('agama'),
                    'jenis_kelamin'     => $request->input('jenis_kelamin'),
                    'kelas'             => $request->input('kelas'),
                    'nama_ayah'         => $request->input('nama_ayah'),
                    'pekerjaan_ayah'    => $request->input('pekerjaan_ayah'),
                    'nama_ibu'          => $request->input('nama_ibu'),
                    'pekerjaan_ibu'     => $request->input('pekerjaan_ibu'),
                    'nama_belakang'     => $request->input('nama_belakang'),
                    'alamat'            => $request->input('alamat'),
                    'nama_wali_murid'   => $request->input('nama_wali_murid'),
                    'no_telp_wali_murid'=> $request->input('no_telp_wali_murid'),
                    'alamat_wali_mulid' => $request->input('alamat_wali_murid'),
                 ];
        
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
