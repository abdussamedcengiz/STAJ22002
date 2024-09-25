<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IletisimModel;


class Iletisim extends Controller
{
    public function index(){
        return view("Iletisim");
    }

    public function ekleme(Request $request){
       $adsoyad= $request->adsoyad;
       $telefon= $request->telefon;
       $mail= $request->mail;
       $metin= $request->metin;
      echo $adsoyad."<br/>";
      echo $telefon."<br/>";
      echo $mail."<br/>";
      echo $metin."<br/>";

      IletisimModel::create([
        "adsoyad"=>$adsoyad,
        "telefon"=>$telefon,
        "mail"=>$mail,
        "metin"=>$metin,

      ]);

      
      echo "bilgileriniz veri tabanına basarılı bir seklde kaydedilmiştir";



    }
}
