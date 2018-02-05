<?php

namespace App\Http\Controllers\SmsGateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Nexmo\Laravel\Facade\Nexmo;
use App\Models\User as User;
use App\Models\Ref_TahunAjar as Ref_TahunAjar;
use App\Models\Ref_Kelas as Ref_Kelas;
use App\Models\DataSiswa as DataSiswa;
use Alert;

class SmsGatewayController extends Controller
{
    public function index()
	{
		$user 		= User::where('level',5)->get();
		$kelas      = Ref_Kelas::pluck('nama','id')->all();
        $tahunajar  = Ref_TahunAjar::pluck('tahun_ajaran','id')->all();

		return view('siswa/sms-gate-way.index', compact('user', 'kelas', 'tahunajar'));
	}
	
	public function send(Request $request)
	{
		$nexmo = app('Nexmo\Client');
		if ($request->input('kelas') !== null) {
		}

		$nexmo->message()->send([
		    'to'   => $request->input('contact'),
		    'from' => 'NEXMO',
		    'text' => $request->input('konten')
		]);

		alert()->success('');
        Alert::success('Pesan Berhasil Dikirim', 'Sukses');
        return redirect()->route('sms-gateway.index');
	}
}
