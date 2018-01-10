<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WaliKelas;
use App\Models\DataGuru;
use App\Models\Ref_Kelas;
use App\Models\Ref_TahunAjar;
use App\Models\Ref_Semester;
use Alert;

class WaliKelasController extends Controller
{
    public function index()
    {
    	$data = WaliKelas::orderBy('id','DESC')->paginate(10);

    	$guru 		= DataGuru::pluck('nama_depan','id')->all();
    	$kelas 		= Ref_Kelas::pluck('nama','id')->all();
    	$semesters  = Ref_Semester::pluck('semester','id')->all();
    	$tahunajar 	= Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

    	return view('guru/wali-kelas.index',compact('data','guru','semesters','tahunajar', 'kelas'));
    }

    public function store(Request $request)
    {
    	WaliKelas::create($request->all());
        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('wali-kelas.index');
    }

    public function update(Request $request,$id)
    {
    	WaliKelas::find($id)->update($request->all());
        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('wali-kelas.index');
    }

    public function destroy($id)
    {   
        WaliKelas::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('wali-kelas.index');
    }
}
