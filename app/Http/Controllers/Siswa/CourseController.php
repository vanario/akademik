<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Pengampu;
use App\Models\DataSiswa;
use App\Models\User;
use App\Models\Ref_Mapel;
use App\Models\Ref_Kelas;
use App\Models\Ref_TahunAjar;
use App\Models\Ref_Semester;
use Auth;
use Alert;
use PDF;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        // return $request;
        $query = Nilai::query();

        if($request->input('siswa_id')) {
            $query->where('siswa_id', $request->input('siswa_id'));
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

        $students   = DataSiswa::all();
        $mapel2     = Ref_Mapel::pluck('nama','id')->all();
        $kelas      = Ref_Kelas::pluck('nama','id')->all();
        $semesters  = Ref_Semester::pluck('semester','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

        return view('siswa/course.index',compact('data','students','semesters','tahunajar', 'kelas', 'mapel2'));
    }

    public function store(Request $request)
    {
        $query = Nilai::query();

        if($request->input('siswa_id')) {
            $query->where('siswa_id', $request->input('siswa_id'));
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
        
        $data = $query->orderBy('id','DESC')->first();
        // return $data;
        if (!empty($data)) {
            alert()->error('');
            Alert::error('Siswa telah terdaftar pada mata pelajaran tersebut', 'Gagal');
            return redirect()->route('course.index');
        } else {
            $data = [
                'mata_pelajaran_id' => $request->input('mata_pelajaran_id'),
                'siswa_id'          => $request->input('siswa_id'),
                'kelas_id'          => $request->input('kelas_id'),
                'semeseter_id'      => $request->input('semester_id'),                    
                'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),
            ];

            Nilai::create($data, $request->all());

            alert()->success('');
            Alert::success('Data berhasil ditambah', 'Sukses');
            return redirect()->route('course.index');
        }
    }
}
