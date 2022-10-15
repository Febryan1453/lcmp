<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DashboardController extends Controller
{    
    public function index()
    {
        return view('template.pages.index');
    }

    public function kategori()
    {
        $kategori = Kategori::all();
        return view('template.pages.kategori',[
            'kategori' => $kategori,
        ]);
    }

    public function save_kategori(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama'  => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors'  => $validator->messages(),
            ]);
        }else{
            $kategori = new Kategori();
            $kategori->nama = $request->input('nama');
            $kategori->slug = Str::slug($request->input('nama'));
            $kategori->save();
            return response()->json([
                'status'    => 200,
                'message'  => 'Data kategori berhasil di tambahkan!',
            ]);
        }
    }
}
