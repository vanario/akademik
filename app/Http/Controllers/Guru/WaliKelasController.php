<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WaliKelas;
use App\Models\DataGuru;
use App\Models\User;
use App\Models\Ref_Kelas;
use App\Models\Ref_TahunAjar;
use App\Models\Ref_Semester;
use Alert;

class WaliKelasController extends Controller
{
    public function index()
    {
    	$data = WaliKelas::with('user')->orderBy('id','DESC')->paginate(10);
        $user = User::where('level',3)->get();
        
        $guru 		= User::where('level',3)->get();
    	$kelas 		= Ref_Kelas::pluck('nama','id')->all();
    	$semesters  = Ref_Semester::pluck('semester','id')->all();
    	$tahunajar 	= Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

    	return view('guru/wali-kelas.index',compact('data','guru','semesters','tahunajar', 'kelas','user'));
    }

    public function store(Request $request)
    {   
        if ($request->input('guru_id') != null) {          
            $data = [
                'guru_id'           => $request->input('guru_id'),
                'kelas_id'          => $request->input('kelas_id'),
                'semester_id'       => $request->input('semester_id'),
                'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),
                'keterangan'        => $request->input('keterangan'),
            ];
        }
        else {
            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('wali-kelas.index');
        }

        WaliKelas::create($data, $request->all());

        //update status waliKelas
        $dataWali = ['wali_kelas' => 'TRUE'];
        User::find($request->input('guru_id'))->update($dataWali, $request->all());
        
        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('wali-kelas.index');
    }

    public function update(Request $request,$id)
    {   
        if ($request->input('guru_id') != null) {            
                     
            $data = [
                    'kelas_id'          => $request->input('kelas_id'),
                    'semester_id'       => $request->input('semester_id'),
                    'tahun_ajaran_id'   => $request->input('tahun_ajaran_id'),
                    'keterangan'        => $request->input('keterangan'),
            ];
        }
        else {

            alert()->error('');
            Alert::error('Nama yang anda masukan salah, Masukan nama sesuai pilihan', 'Gagal');
            return redirect()->route('wali-kelas.index');
        }
    	WaliKelas::find($id)->update($data, $request->all());
        
        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('wali-kelas.index');
    }

    public function destroy($id)
    {   
        $waliKelas = WaliKelas::find($id);
        
        // update status wali kelas di data user
        $dataWali = ['wali_kelas' => 'FALSE'];
        User::find($waliKelas->guru_id)->update($dataWali);

        // proses delete wali kelas
        $waliKelas->delete();

        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('wali-kelas.index');
    }
}
