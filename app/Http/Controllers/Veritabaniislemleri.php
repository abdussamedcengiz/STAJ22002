<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Veritabaniislemleri extends Controller
{
    public function ekle(){
        DB::table("bilgilerr")->insert([
            "metin"=>"bu ornek bir 2  metin bilgisidir"
        ]);
    }

    public function guncelle(){
        DB::table("bilgilerr")->where("id",1)->update([
            "metin"=>"bu ornek bie metin guncellenmistir"
        ]);
    }
    public function sil(){
        DB::table("bilgilerr")->where("id",1)->delete(
       );
    }
    public function bilgiler(){
      $veriler=DB::table("bilgilerr")->where("id",2)->first();
      echo $veriler->metin;

    }
}
