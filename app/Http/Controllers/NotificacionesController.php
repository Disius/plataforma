<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function notificationCoordinacion(): \Illuminate\Database\Eloquent\Collection|array|null
    {
        if (auth()->user() != null){
            return User::with(['notifications'])->where('id', auth()->user()->id)->get();
        } else {
            return null;
        }
    }
    public function read_notifications($id){
        $user = User::find($id);

        echo $user;
    }
}
