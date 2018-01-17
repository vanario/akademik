<?php

namespace App\Http\Controllers\NilaiSiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Nilai;

class NilaiSiswaController extends Controller
{
    public function index(Request $request)
    {
    	$siswa_id = Auth::id();

        $data = Nilai::with('siswa','mapel')->where('siswa_id',$siswa_id)->paginate(10);

            $pelajaran = array();
            foreach ($data as $value) {
            	$pelajaran[] = $value->mata_pelajaran_id;
            }

        // $mapels     = Ref_Mapel::whereIn('id', $pelajaran)->orderBy('id','DESC')->get();
        // $kelas      = Ref_Kelas::pluck('nama','id')->all();
        // $semesters  = Ref_Semester::pluck('semester','id')->all();
        // $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

        return view('nilai-siswa.index',compact('data','user','mapels','semesters','tahunajar', 'kelas'));
    }
}
