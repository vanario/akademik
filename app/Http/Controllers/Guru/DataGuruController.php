<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataGuru;
use App\Models\WaliKelas;
use App\Models\Pengampu;
use App\Models\User;
use Alert;

class DataGuruController extends Controller
{
    public function index()
    {
    	$data = DataGuru::with('user')->orderBy('id','DESC')->paginate(10);
        // return response()->json($data);
        $user = User::where('level',3)->get();

    	return view('guru/data-guru.index',compact('data','user'));
    }

    public function show($id)
    {
        $query = DataGuru::with('user')->orderBy('id','DESC')->get();
        foreach ($query as $value) {
            $data = $value;
        }
        $data_wali     = WaliKelas::with('guru')->where('guru_id', $data->id)->get()->find($id);
        $data_pengampu = Pengampu::with('guru')->where('guru_id', $data->id)->get()->find($id);

        return view('guru/data-guru.detail',compact('data_wali','data_pengampu'));
    }

    public function store(Request $request)
    {   
        $this->validate($request, ['nip' => 'required|numeric']);

        if ($request->input('user_id') != null) {            
                     
            $data = [
                'nik'               => $request->input('nik'),
                'nip'               => $request->input('nip'),
                'user_id'           => $request->input('user_id'),
                'nama_depan'        => $request->input('nama_depan'),
                'nama_belakang'     => $request->input('nama_belakang'),
                'alamat'            => $request->input('alamat'),
                'no_telp'           => $request->input('no_telp'),                    
                'tempat_lahir'      => $request->input('tempat_lahir'),                    
                'tanggal_lahir'     => $request->input('tanggal_lahir'),                    
                'jenis_kelamin'     => $request->input('jenis_kelamin'),                    
                'nama_ibu_kandung'  => $request->input('nama_ibu_kandung'),                    
                'pendidikan_terakhir'  => $request->input('pendidikan_terakhir'),                    
                'status_kepegawaian'  => $request->input('status_kepegawaian'),                    
            ];

        }
        else {

            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('data-guru.index');
        }


            $dataWali = ['wali_kelas' => $request->input('waliKelas')];
            User::find($request->input('user_id'))->update($dataWali, $request->all());
            DataGuru::create($data, $request->all());

            alert()->success('');
            Alert::success('Data berhasil ditambah', 'Sukses');
            return redirect()->route('data-guru.index');
    }

    public function update(Request $request,$id)
    {

        $this->validate($request, ['nip' => 'required|numeric']);
        
        if ($request->input('user_id') != null) {            
                     
            $data = [
                'nik'               => $request->input('nik'),
                'nip'               => $request->input('nip'),
                'user_id'           => $request->input('user_id2'),
                'nama_depan'        => $request->input('nama_depan'),
                'nama_belakang'     => $request->input('nama_belakang'),
                'alamat'            => $request->input('alamat'),
                'no_telp'           => $request->input('no_telp'),                    
                'tempat_lahir'      => $request->input('tempat_lahir'),                    
                'tanggal_lahir'     => $request->input('tanggal_lahir'),                    
                'jenis_kelamin'     => $request->input('jenis_kelamin'),                    
                'nama_ibu_kandung'  => $request->input('nama_ibu_kandung'),                    
                'pendidikan_terakhir'  => $request->input('pendidikan_terakhir'),                    
                'status_kepegawaian'  => $request->input('status_kepegawaian'),                    
            ];
        }

        else {
            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('data-guru.index');
        }

    	DataGuru::find($id)->update($data, $request->all());

        //update status waliKelas
        $dataWali = ['wali_kelas' => $request->input('waliKelas')];
        User::find($request->input('user_id2'))->update($dataWali, $request->all());

        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('data-guru.index');
    }

    public function destroy($id)
    {   
        DataGuru::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('data-guru.index');
    }
}
