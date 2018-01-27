<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ref_Kelas;
use App\Models\Ref_Semester;
use App\Models\Ref_TahunAjar;
use App\Models\Ekstrakurikuler;
use Alert;
class EkstrakurikulerController extends Controller
{
    public function index(Request $request)
    {
    	$siswa = User::where('level',4)->get();

        $query = Ekstrakurikuler::query();

            if($request->input('user_id2')) {
                $query->where('nama_siswa', $request->input('user_id2'));
            }            
            if($request->input('kelas_id')) {
                $query->where('kelas_id', $request->input('kelas_id'));
            }
            if($request->input('tahun_ajaran_id')) {
                $query->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'));
            }
            if($request->input('semester_id')) {
                $query->where('semester_id', $request->input('semester_id'));
            }
            $data = $query->with('semesters','siswa','tahun_ajaran','kelas')->orderBy('id','DESC')->paginate(10);

        $kelas      = Ref_Kelas::pluck('nama','id')->all();
        $semesters  = Ref_Semester::pluck('semester','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

    	return view('siswa/ekstrakurikuler.index',compact('data','siswa','semesters','tahunajar', 'kelas'));
    }

    public function store(Request $request)
    {   
        if ($request->input('siswa_id') != null) {            
                     
         $data = [
                    'nama_siswa'        => $request->input('siswa_id'),
                    'kode_ekstrak'		=> $request->input('kode_ekstrak'),
                    'nis'	    		=> $request->input('nis'),
                    'kelas_id'          => $request->input('kelas_id'),
                    'nama_ekstrak' 		=> $request->input('nama_ekstrak'),
                    'nilai'				=> $request->input('nilai'),
                    'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),                    
                    'semester_id'	 	=> $request->input('semester_id'),                    
                    'keterangan' 	 	=> $request->input('keterangan'),                    
                 ];

        }
        else {

            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('presensi.index');
        }

            Ekstrakurikuler::create($data, $request->all());

            alert()->success('');
            Alert::success('Data berhasil ditambah', 'Sukses');
            return redirect()->route('ekstrak.index');
    }

    public function update(Request $request,$id)
    {
         $data = [
                    'kode_ekstrak'		=> $request->input('kode_ekstrak'),
                    'nis'	    		=> $request->input('nis'),
                    'kelas_id'          => $request->input('kelas_id'),
                    'nama_ekstrak' 		=> $request->input('nama_ekstrak'),
                    'nilai'				=> $request->input('nilai'),
                    'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),                    
                    'semester_id'	 	=> $request->input('semester_id'),                    
                    'keterangan' 	 	=> $request->input('keterangan'),    
                 ];
         
    	Ekstrakurikuler::find($id)->update($data, $request->all());

        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('ekstrak.index');
    }

    public function destroy($id)
    {   
        Ekstrakurikuler::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('ekstrak.index');
    }
}
