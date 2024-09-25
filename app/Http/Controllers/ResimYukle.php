<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResimYukle extends Controller
{
   public function ResimYukleme(Request $request){
    $resimadi=rand(0,1000).".".$request->resim->getClientOriginalExtension();
    $yükle=$request->resim->move(public_path("images"),$resimadi);
   }
}
