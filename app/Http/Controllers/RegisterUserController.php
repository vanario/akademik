<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;
use App\Models\User;

class RegisterUserController extends Controller
{
	public function index()
    {
    	$data = User::orderBy('id','DESC')->paginate(10);

    	return view('register',compact('data'));
    }
    
    protected function create(Request $data)
    {
    	$this->validate($data,[

            'name' 		=> 'required|string|max:255',
            'email'		=> 'required|string|email|max:255|unique:users',
            'level' 	=> 'required',
            'password'  => 'required|string|min:6|confirmed',

            ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'level' => $data['level'],
            'password' => bcrypt($data['password']),
        ]);

        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('register.index');

    }

    protected function update(Request $data,$id)
    {	
    	$this->validate($data,[

            'name' 		=> 'required|string|max:255',
            'email'		=> 'required|string|email|max:255',
            'level' 	=> 'required',
            ]);

        User::find($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'level' => $data['level'],
        ]);

        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('register.index');
    }

    public function destroy($id)
    {   
        User::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('register.index');
    }
}
