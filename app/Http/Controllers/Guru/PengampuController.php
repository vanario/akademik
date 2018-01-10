<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengampu;
use App\Models\DataGuru;
use App\Models\Ref_Mapel;
use App\Models\Ref_Kelas;
use App\Models\Ref_TahunAjar;
use App\Models\Ref_Semester;
use Alert;

class PengampuController extends Controller
{
    public function index()
    {
    	$data = Pengampu::orderBy('id','DESC')->paginate(10);

    	$guru 		= DataGuru::pluck('nama_depan','id')->all();
    	$mapel 		= Ref_Mapel::pluck('nama','id')->all();
    	$kelas 		= Ref_Kelas::pluck('nama','id')->all();
    	$semesters  = Ref_Semester::pluck('semester','id')->all();
    	$tahunajar 	= Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

    	return view('guru/pengampu.index',compact('data','guru','mapel','semesters','tahunajar', 'kelas'));
    }

    public function store(Request $request)
    {
    	Pengampu::create($request->all());
        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('pengampu.index');
    }

    public function update(Request $request,$id)
    {
    	Pengampu::find($id)->update($request->all());
        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('pengampu.index');
    }

    public function destroy($id)
    {   
        Pengampu::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('pengampu.index');
    }
}
