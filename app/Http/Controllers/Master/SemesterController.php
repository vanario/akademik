<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ref_Semester;
use Alert;

class SemesterController extends Controller
{
    public function index()
    {
    	$data = Ref_Semester::paginate(10);

    	return view('data-master/semester.index',compact('data'));
    }

    public function store(Request $request)
    {
    	Ref_Semester::create($request->all());
        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('semester.index');
    }

    public function update(Request $request,$id)
    {
    	Ref_Semester::find($id)->update($request->all());
        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('semester.index');
    }

    public function destroy($id)
    {   
        Ref_Semester::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('semester.index');
    }
}
