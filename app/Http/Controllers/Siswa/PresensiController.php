<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\DataSiswa;
use App\Models\Ref_Kelas;
use App\Models\Ref_Semester;
use App\Models\Ref_TahunAjar;
use Alert;

class PresensiController extends Controller
{
    public function index()
    {
    	$data       = Presensi::with('siswa','kelas','semester','tahun_ajaran')->paginate(10);
        $siswa      = DataSiswa::get();
        $kelas      = Ref_Kelas::pluck('nama','id')->all();
        $semesters  = Ref_Semester::pluck('semester','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

    	return view('siswa/presensi.index',compact('data','siswa','semesters','tahunajar', 'kelas'));
    }

    public function store(Request $request)
    {   
        if ($request->input('siswa_id') != null) {            
                     
         $data = [
                    'siswa_id'          => $request->input('siswa_id'),
                    'alpa'	    		=> $request->input('alpa'),
                    'sakit'	    		=> $request->input('sakit'),
                    'izin'			    => $request->input('izin'),
                    'keterangan'	    => $request->input('keterangan'),
                    'kelas_id'          => $request->input('kelas_id'),
                    'semeseter_id'      => $request->input('semester_id'),                    
                    'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),                    
                 ];

        }
        else {

            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('presensi.index');
        }

            Presensi::create($data, $request->all());

            alert()->success('');
            Alert::success('Data berhasil ditambah', 'Sukses');
            return redirect()->route('presensi.index');
    }

    public function update(Request $request,$id)
    {
     	// return $request;  
        if ($request->input('siswa_id2') != null) {            
                     
         $data = [
                    'siswa_id'          => $request->input('siswa_id2'),
                    'alpa'	    		=> $request->input('alpa'),
                    'sakit'	    		=> $request->input('sakit'),
                    'izin'			    => $request->input('izin'),
                    'keterangan'	    => $request->input('keterangan'),
                    'kelas_id'          => $request->input('kelas_id'),
                    'semeseter_id'      => $request->input('semester_id'),                    
                    'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),  
                 ];
         }

        else {
            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('presensi.index');
        }

    	Presensi::find($id)->update($data, $request->all());

        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('presensi.index');
    }

    public function destroy($id)
    {   
        Presensi::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('presensi.index');
    }
}
