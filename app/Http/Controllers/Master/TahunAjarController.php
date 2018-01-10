<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ref_TahunAjar;
use Alert;

class TahunAjarController extends Controller
{
    public function index()
    {
    	$data = Ref_TahunAjar::orderBy('id','DESC')->paginate(10);

    	return view('data-master/tahun-ajar.index',compact('data'));
    }

    public function store(Request $request)
    {
    	Ref_TahunAjar::create($request->all());
        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('tahun-ajar.index');
    }

    public function update(Request $request,$id)
    {
    	Ref_TahunAjar::find($id)->update($request->all());
        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('tahun-ajar.index');
    }

    public function destroy($id)
    {   
        Ref_TahunAjar::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('tahun-ajar.index');
    }
}
