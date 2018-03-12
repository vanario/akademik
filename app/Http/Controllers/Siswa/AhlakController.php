<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AhlakDanKepribadian;
use App\Models\Ref_Kelas;
use App\Models\Ref_TahunAjar;
use App\Models\User;
use App\Models\DataSiswa;
use Alert;

class AhlakController extends Controller
{
    public function index(Request $request)
    {
    	$siswa      = DataSiswa::all();

        $query = AhlakDanKepribadian::query();

            if($request->input('user_id2')) {
                $query->where('nama_siswa', $request->input('user_id2'));
            }            
            if($request->input('kelas_id')) {
                $query->where('kelas_id', $request->input('kelas_id'));
            }
            if($request->input('tahun_ajaran_id')) {
                $query->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'));
            }
            $data = $query->orderBy('id','DESC')->paginate(10);
        
        $kelas      = Ref_Kelas::pluck('nama','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

    	return view('siswa/ahlak-dan-kepribadian.index',compact('data','siswa','semesters','tahunajar', 'kelas'));
    }

    public function store(Request $request)
    {   
        if ($request->input('siswa_id') != null) {            
                     
         $data = [
                    'kode_kepribadian'	=> $request->input('kode_kepribadian'),
                    'nis'	    		=> $request->input('nis'),
                    'nama_siswa'        => $request->input('siswa_id'),
                    'kelas_id'          => $request->input('kelas_id'),
                    'Ahlak'	    		=> $request->input('Ahlak'),
                    'Kepribadian'		=> $request->input('Kepribadian'),
                    'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),                    
                 ];

        }
        else {

            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('ahlak.index');
        }

            AhlakDanKepribadian::create($data, $request->all());

            alert()->success('');
            Alert::success('Data berhasil ditambah', 'Sukses');
            return redirect()->route('ahlak.index');
    }

    public function update(Request $request,$id)
    {
         $data = [
                    'kode_kepribadian'	=> $request->input('kode_kepribadian'),
                    'nis'	    		=> $request->input('nis'),
                    'kelas_id'          => $request->input('kelas_id'),
                    'Ahlak'	    		=> $request->input('Ahlak'),
                    'Kepribadian'		=> $request->input('Kepribadian'),
                    'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),    
                 ];
         
    	AhlakDanKepribadian::find($id)->update($data, $request->all());

        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('ahlak.index');
    }

    public function destroy($id)
    {   
        AhlakDanKepribadian::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('ahlak.index');
    }
}
