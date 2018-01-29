<?php

namespace App\Http\Controllers\SmsGateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Nexmo\Laravel\Facade\Nexmo;
use Alert;

class SmsGatewayController extends Controller
{
    public function index()
	{
		return view('siswa/sms-gate-way.index');
	}
	
	public function send(Request $request)
	{
		$nexmo = app('Nexmo\Client');

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
