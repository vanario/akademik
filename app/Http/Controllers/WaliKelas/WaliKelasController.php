<?php

namespace App\Http\Controllers\WaliKelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\WaliKelas;
use App\Models\Ref_Mapel;
use App\Models\Ref_Kelas;
use App\Models\Ref_Semester;
use App\Models\Ref_TahunAjar;
use App\Models\User;
use Auth;


class WaliKelasController extends Controller
{

    public function index(Request $request)
    {
        $kelas_id       = $this->Kelas();
        $semester_id    = $this->Semester();
        $tahun_id       = $this->Tahun();

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
            
        $data   = $query->with('siswa','mapel')->whereIn('kelas_id',$kelas_id)
                        ->whereIn('tahun_ajaran_id',$tahun_id) 
                        ->whereIn('semeseter_id',$semester_id) 
                        ->orderBy('mata_pelajaran_id','DESC')->paginate(10);
        $siswa  = User::get();

        $pelajaran = array();
        foreach ($data as $value) {
            $pelajaran[] = $value->mata_pelajaran_id;
        }


        $mapels     = Ref_Mapel::whereIn('id', $pelajaran)->orderBy('id','DESC')->get();
        $kelas      = Ref_Kelas::pluck('nama','id')->all();
        $semesters  = Ref_Semester::pluck('semester','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

        return view('wali-kelas.index',compact('data','user','mapels','semesters','tahunajar', 'kelas','siswa'));
    }

    /*public function index()
    {
        $data = Nilai::with('siswa','mapel','tahun_ajaran','semester')->select('id','siswa_id','semeseter_id','tahun_ajaran_id')->groupBy('id','siswa_id','semeseter_id','tahun_ajaran_id')->paginate(10);

        return view('wali-kelas.index',compact('data'));
    }*/
    public function Kelas()
    {   
        $user_id = Auth::id();
        $query = WaliKelas::where('guru_id',$user_id)->get();

        $kelas = array();
        foreach ($query as $value) {
            $kelas[] = $value->kelas_id;
        }

        return $kelas;
    }

    public function Semester()
    {   
        $user_id = Auth::id();
        $query = WaliKelas::where('guru_id',$user_id)->get();

        $semester = array();
        foreach ($query as $value) {
            $semester[] = $value->semester_id;
        }

        return $semester;
    }

    public function Tahun()
    {   
        $user_id = Auth::id();
        $query = WaliKelas::where('guru_id',$user_id)->get();

        $tahun = array();
        foreach ($query as $value) {
            $tahun[] = $value->tahun_ajaran_id;
        }

        return $tahun;
    }
}
