<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function image(){
        echo asset('storage/Tec-Tuxtla_Logo.png');
    }
    public function imageTecnm(){
        echo asset('storage/tecnm.jpg');
    }
}
