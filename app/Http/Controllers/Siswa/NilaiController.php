<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\DataSiswa;
use App\Models\Ref_Mapel;
use App\Models\Ref_Kelas;
use App\Models\Ref_TahunAjar;
use App\Models\Ref_Semester;
use Alert;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $siswa      = DataSiswa::get();

            $query = Nilai::query();

            if($request->input('user_id2')) {
                $query->where('siswa_id', $request->input('user_id2'));
            }
            if($request->input('mata_pelajaran_id')) {
                $query->where('mata_pelajaran_id', $request->input('mata_pelajaran_id'));
            }
            if($request->input('kelas_id')) {
                $query->where('kelas_id', $request->input('kelas_id'));
            }
            if($request->input('tahun_ajaran_id')) {
                $query->where('tahun_ajaran_id', $request->input('tahun_ajaran_id'));
            }
            if($request->input('semester_id')) {
                $query->where('semeseter_id', $request->input('semester_id'));
            }
            
            $data = $query->orderBy('id','DESC')->paginate(10);

        $mapel      = Ref_Mapel::pluck('nama','id')->all();
        $kelas      = Ref_Kelas::pluck('nama','id')->all();
        $semesters  = Ref_Semester::pluck('semester','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

        return view('siswa/nilai.index',compact('data','siswa','mapel','semesters','tahunajar', 'kelas'));
    }

    public function store(Request $request)
    {   
        $this->validate($request, [

            'nilai' => 'required|numeric'

            ]);
        
        if ($request->input('siswa_id') != null) {            
                     
         $data = [
                    'mata_pelajaran_id' => $request->input('mata_pelajaran_id'),
                    'siswa_id'          => $request->input('siswa_id'),
                    'nilai'       		=> $request->input('nilai'),
                    'ketarangan'	    => $request->input('keterangan'),
                    'kelas_id'          => $request->input('kelas_id'),
                    'semeseter_id'      => $request->input('semester_id'),                    
                    'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),                    
                 ];

        }
        else {

            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('nilai.index');
        }

            Nilai::create($data, $request->all());

            alert()->success('');
            Alert::success('Data berhasil ditambah', 'Sukses');
            return redirect()->route('nilai.index');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [

            'nilai' => 'required|numeric'

            ]);
        
        if ($request->input('siswa_id2') != null) {            
                     
         $data = [
                    'mata_pelajaran_id' => $request->input('mata_pelajaran_id'),
                    'siswa_id'          => $request->input('siswa_id2'),
                    'nilai'       		=> $request->input('nilai'),
                    'ketarangan'	    => $request->input('keterangan'),
                    'kelas_id'          => $request->input('kelas_id'),
                    'semeseter_id'      => $request->input('semester_id'),                    
                    'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),
                 ];
         }

        else {
            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('nilai.index');
        }

    	Nilai::find($id)->update($data, $request->all());

        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('nilai.index');
    }

    public function destroy($id)
    {   
        Nilai::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('nilai.index');
    }
}
