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
use App\Models\DataGuru;
use Auth;
use Alert;
use PDF;

class NilaiController extends Controller
{
    public function index(Request $request)
    {         
        $mapel_id       = $this->Pengampu(); 
        $mata_pelajaran = $request->input('mata_pelajaran_id');
        $resultMapel    = Ref_Mapel::find($mata_pelajaran);

        $student        = $request->input('siswa');
        $resultStudent  = DataSiswa::find($student);

        $class          = $request->input('kelas_id');
        $resultClass    = Ref_Kelas::find($class);

        $tahunAjaran    = $request->input('tahun_ajaran_id');
        $resultAjaran   = Ref_TahunAjar::find($tahunAjaran);

        $semesteran       = $request->input('semester_id');
        $resultSemesteran = Ref_Semester::find($semesteran);

        $query = Nilai::query();

        if($student) {
            $query->where('siswa_id', $student);
        }
        if($mata_pelajaran) {
            $query->where('mata_pelajaran_id', $mata_pelajaran);
        }
        if($class) {
            $query->where('kelas_id', $class);
        }
        if($tahunAjaran) {
            $query->where('tahun_ajaran_id', $tahunAjaran);
        }
        if($semesteran) {
            $query->where('semeseter_id', $semesteran);
        }
        
        $data = $query->with('mapel', 'kelas', 'semester', 'tahun_ajaran')->orderBy('id','DESC')->paginate(10);

        $siswa      = DataSiswa::all();
        $mapel      = Ref_Mapel::whereIn('id',$mapel_id)->pluck('nama','id')->all();

        $teacher    = DataGuru::where('user_id', Auth::user()->id)->first();        
        $mapel2     = Pengampu::with('mapel')->where('guru_id', $teacher->id)->get();

        $kelas      = Ref_Kelas::pluck('nama','id')->all();
        $semesters  = Ref_Semester::pluck('semester','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

        if ($request->input('type_nilai') == '0' || $request->input('type_nilai') == '') {
            return view('siswa/nilai.index',compact(
                    'data','siswa','mapel','semesters','tahunajar', 'kelas', 'mapel2',
                    'resultClass', 'resultAjaran', 'resultSemesteran', 'resultMapel', 'resultStudent'
            ));
        } elseif ($request->input('type_nilai') == '1') {
            return view('siswa/nilai.harian',compact(
                    'data','siswa','mapel','semesters','tahunajar', 'kelas', 'mapel2',
                    'resultClass', 'resultAjaran', 'resultSemesteran', 'resultMapel', 'resultStudent'
            ));
        } elseif ($request->input('type_nilai') == '2') {
            return view('siswa/nilai.tugas',compact(
                    'data','siswa','mapel','semesters','tahunajar', 'kelas', 'mapel2',
                    'resultClass', 'resultAjaran', 'resultSemesteran', 'resultMapel', 'resultStudent'
            ));
        } elseif ($request->input('type_nilai') == '3') {
            return view('siswa/nilai.praktik',compact(
                    'data','siswa','mapel','semesters','tahunajar', 'kelas', 'mapel2',
                    'resultClass', 'resultAjaran', 'resultSemesteran', 'resultMapel', 'resultStudent'
            ));
        } elseif ($request->input('type_nilai') == '4') {
            return view('siswa/nilai.uts',compact(
                    'data','siswa','mapel','semesters','tahunajar', 'kelas', 'mapel2',
                    'resultClass', 'resultAjaran', 'resultSemesteran', 'resultMapel', 'resultStudent'
            ));
        } elseif ($request->input('type_nilai') == '5') {
            return view('siswa/nilai.uas',compact(
                    'data','siswa','mapel','semesters','tahunajar', 'kelas', 'mapel2',
                    'resultClass', 'resultAjaran', 'resultSemesteran', 'resultMapel', 'resultStudent'
            ));
        }
    }

    public function print()
    {
        $mapel_id = $this->Pengampu();

        $siswa      = DataSiswa::all();
        $mapel      = Ref_Mapel::whereIn('id',$mapel_id)->pluck('nama','id')->all();
        $kelas      = Ref_Kelas::pluck('nama','id')->all();
        $semesters  = Ref_Semester::pluck('semester','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

        return view('siswa/nilai.pdfprint',compact('data','user','mapel','semesters','tahunajar', 'kelas','siswa'));
    }

    public function pdf(Request $request)
    {
        $mapel_id = $this->Pengampu();

        $query = Nilai::query();

        if($request->input('user_id')) {
            $query->where('siswa_id', $request->input('user_id'));
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
            
        $data   = $query->with('siswa','mapel','data_siswa','kelas','semester','tahun_ajaran')->orderBy('mata_pelajaran_id','DESC')->paginate(10);

        $pdf = PDF::loadView('siswa/nilai.pdf',compact('value','data','user','mapels','semesters','tahunajar', 'kelas','siswa'))->setPaper('letter', 'landscape');
            
        return $pdf->stream();     
    }

    public function Pengampu()
    {   
        $user_id = Auth::id();
        $query = Pengampu::where('guru_id',$user_id)->get();

        $mapel = array();
        foreach ($query as $value) {
            $mapel[] = $value->mapel_id;
        }

        return $mapel;
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'ulangan_harian1' => 'required|numeric',
            'ulangan_harian2' => 'required|numeric',
            'ulangan_harian3' => 'required|numeric',
            'nilai_tugas1'    => 'required|numeric',
            'nilai_tugas2'    => 'required|numeric',
            'nilai_tugas3'    => 'required|numeric',
            'ujian_praktik'   => 'required|numeric',
            'uts'             => 'required|numeric',
            'nilai'           => 'required|numeric',

        ]);
        
        if ($request->input('siswa_id') != null) {          
                     
            $data = [
                'mata_pelajaran_id' => $request->input('mata_pelajaran_id'),
                'siswa_id'          => $request->input('siswa_id'),
                'ulangan_harian1'   => $request->input('ulangan_harian1'),
                'ulangan_harian2'   => $request->input('ulangan_harian2'),
                'ulangan_harian3'   => $request->input('ulangan_harian3'),
                'nilai_tugas1'      => $request->input('nilai_tugas1'),
                'nilai_tugas2'      => $request->input('nilai_tugas2'),
                'nilai_tugas3'      => $request->input('nilai_tugas3'),
                'ujian_praktik'     => $request->input('ujian_praktik'),
                'uts'               => $request->input('uts'),
                'nilai'             => $request->input('nilai'),
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
    	Nilai::find($id)->update($request->all());

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

    public function studentWithCourse(Request $request)
    {
        if ($request->input('siswa_id') != null) {          
                     
            $data = [
                'mata_pelajaran_id' => $request->input('mata_pelajaran_id'),
                'siswa_id'          => $request->input('siswa_id'),
                'ulangan_harian1'   => $request->input('ulangan_harian1'),
                'ulangan_harian2'   => $request->input('ulangan_harian2'),
                'ulangan_harian3'   => $request->input('ulangan_harian3'),
                'nilai_tugas1'      => $request->input('nilai_tugas1'),
                'nilai_tugas2'      => $request->input('nilai_tugas2'),
                'nilai_tugas3'      => $request->input('nilai_tugas3'),
                'ujian_praktik'     => $request->input('ujian_praktik'),
                'uts'               => $request->input('uts'),
                'nilai'             => $request->input('nilai'),
                'ketarangan'        => $request->input('keterangan'),
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
}
