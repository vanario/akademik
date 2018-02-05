<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataSiswa;
use App\Models\User;
use App\Models\Ref_Mapel;
use App\Models\Ref_Kelas;
use App\Models\Ref_TahunAjar;
use App\Models\Ref_Semester;
use App\Models\StudentsHasClasses;
use Alert;

class SiswaHasKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students   = DataSiswa::all();
        $classes    = Ref_Kelas::pluck('nama','id')->all();
        $semesters  = Ref_Semester::pluck('semester','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();
        $user       = User::where('level',4)->get();

        $studentId          = $request->input('siswa_id');
        $classId            = $request->input('kelas_id');
        $tahunAjarId        = $request->input('tahun_ajaran_id');
        $studentHasClasses  = '';
        if ($studentId) {
            $studentHasClasses = StudentsHasClasses::with('student', 'classes', 'tahunAjar', 'semester')
                ->where('siswa_id', $studentId)
                ->where('kelas_id', $classId)
                ->where('tahun_ajaran_id', $tahunAjarId)
                ->get();
        } else {
            $studentHasClasses = StudentsHasClasses::all();
        }

        return view('siswa-has-kelas.index',compact('students', 'classes', 'semesters', 'tahunajar', 'user', 'data', 'studentHasClasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $data = [
            'siswa_id'          => $request->input('siswa'),
            'kelas_id'          => $request->input('kelas'),
            'tahun_ajaran_id'   => $request->input('tahun_ajaran'),
            'semester_id'       => $request->input('semester'),
            'status'            => 'Active',                 
        ];

        StudentsHasClasses::create($data, $request->all());

        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('siswa-has-kelas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
