<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ref_Mapel;
use Alert;

class MapelController extends Controller
{
    public function index()
    {
    	$data = Ref_Mapel::paginate(10);

    	return view('data-master/mapel.index',compact('data'));
    }

    public function store(Request $request)
    {
    	Ref_Mapel::create($request->all());
        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('mapel.index');
    }

    public function update(Request $request,$id)
    {
    	Ref_Mapel::find($id)->update($request->all());
        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('mapel.index');
    }

    public function destroy($id)
    {   
        Ref_Mapel::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('mapel.index');
    }
}
