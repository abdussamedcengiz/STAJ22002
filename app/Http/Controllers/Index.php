<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kayitModel;

class Index extends Controller
{
    public function control(Request $bilgiler){
        $bilgiler->validate([
            "username" => "required|min:3|max:50",
            "email" => "required|email",
            "password" => "required|min:3|max:50",
            "repassword" => "required|min:3|max:50|same:password" // "same" ile şifrelerin eşleştiğini kontrol edin
        ]);

        $username= $bilgiler->username;
       $email= $bilgiler->email;
       $password= $bilgiler->password;
       $repassword= $bilgiler->repassword;
      echo $username."<br/>";
      echo $email."<br/>";
      echo $password."<br/>";
      echo $repassword."<br/>";

      kayitModel::create([
        "username"=>$username,
        "email"=>$email,
        "password"=>$password,
        "repassword"=>$repassword

      ]);



    }

}
