<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ref_Kelas;
use Alert;

class KelasController extends Controller
{
    public function index()
    {
    	$data = Ref_Kelas::paginate(10);

    	return view('data-master/kelas.index',compact('data'));
    }

    public function store(Request $request)
    {
    	Ref_Kelas::create($request->all());
        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('kelas.index');
    }

    public function update(Request $request,$id)
    {
    	Ref_Kelas::find($id)->update($request->all());
        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('kelas.index');
    }

    public function destroy($id)
    {   
        Ref_Kelas::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('kelas.index');
    }
}
