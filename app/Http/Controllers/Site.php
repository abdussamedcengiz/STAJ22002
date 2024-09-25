<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Site extends Controller
{
    public function sitee(){

        $data["yazi1"]="samet";
        $data["yazi2"]="cengiz";
        return view("site",$data);
    }
}
