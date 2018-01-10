<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use File;
use Alert;

class SliderController extends Controller
{
   
    public function index()
    {
        $data = Slider::orderBy('id','DESC')->paginate(5);

        return view('data-master/slider.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = [
            'image'             => $request->input('image'),
            'title'             => $request->input('title'),
            'description'       => $request->input('description'),
        ];

        $directoryPath  = public_path('image/news/');                 
       
        if(File::isDirectory($directoryPath)){

        
            if($request->file('gambar') == "") {
                $data['image']  = "";
            } 
            else {
                
                $file             = $request->file('gambar');
                $imageName        = $file->getClientOriginalName();
                $imageReplaceName = str_replace(' ', '_', $imageName);
                $request->file('gambar')->move('image/news/', $imageReplaceName);
                $data['image']    = asset('image/news/'.$imageReplaceName);
            }
        } 

        else {
        
        File::makeDirectory($directoryPath);
        
            if($request->file('gambar') == "") {
                $data['image']  = "";
            } 
            else {
                
                $file             = $request->file('gambar');
                $imageName        = $file->getClientOriginalName();
                $imageReplaceName = str_replace(' ', '_', $imageName);
                $request->file('gambar')->move('image/slider/', $imageReplaceName);
                $data['image']  = asset('image/news/'.$imageReplaceName);
            }
        }

        Slider::create($data, $request->all());
        alert()->success('');
        Alert::success('Data berhasil ditambah', 'Sukses');
        return redirect()->route('slider.index');

    }

    public function update(Request $request, $id)
    {
        $data   = Slider::where('id', $id)->first();
        $image  = $data->image;

        $data = [
            'image'             => $request->input('image'),
            'title'             => $request->input('title'),
            'description'       => $request->input('description'),
        ];

        $directoryPath  = public_path('image/news/');
        

        if(File::isDirectory($directoryPath)) {
        
            if($request->file('gambar') == ""){
                $data['image']= $image;
            } else{
                $file           = $request->file('gambar');
                $imageName      = $file->getClientOriginalName();
                $imageReplaceName = str_replace(' ', '_', $imageName);  
                $request->file('gambar')->move('image/slider/', $imageReplaceName);
                $data['image']  = asset('image/news/'.$imageReplaceName);
            }
        } else {
        
        File::makeDirectory($directoryPath);
        
            if($request->file('gambar') == "") {
                $data['image']= $image;
            } 
            else{
                $file           = $request->file('gambar');
                $imageName      = $file->getClientOriginalName();
                $imageReplaceName = str_replace(' ', '_', $imageName); 
                $request->file('gambar')->move('image/news/', $imageReplaceName);
                $data['image']  = asset('image/news/'.$imageReplaceName);
            }
        }

        Slider::find($id)->update($data, $request->all());
        alert()->success('');
        Alert::success('Data berhasil diubah', 'Sukses');
        return redirect()->route('slider.index');
    }

    public function destroy($id)
    {   
        Slider::find($id)->delete();
        alert()->success('');
        Alert::success('Data berhasil dihapus', 'Sukses');
        return redirect()->route('slider.index');
    }
}