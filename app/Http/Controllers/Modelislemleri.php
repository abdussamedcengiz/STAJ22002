<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bilgilerr;

class Modelislemleri extends Controller
{
    public function liste(){
    $bilgi=Bilgilerr::whereId(2)->first();
    echo $bilgi->metin;
    }

    public function ekle(){
        Bilgilerr::create([
            "metin"=>"samet cengiz.",
        ]);
    }
    public function guncelle(){
        Bilgilerr::whereId(4)-> update([
            "metin"=>"samet cengiz",
        ]);
    }
    public function sil(){
        
        Bilgilerr::whereId(4)->delete();
        
    }
}
