<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function notificationCoordinacion(): \Illuminate\Database\Eloquent\Collection|array|null
    {
        if (auth()->user() != null){
            $user = User::find(auth()->user()->id);
            return $user->unreadNotifications;
        } else {
            return null;
        }
    }
    public function read_notifications($id){
        $user = User::find($id);

        foreach ($user->unreadNotifications as $notification){
            $notification->markAsRead();
        }

        return redirect()->route('index.necesidad');
    }
}
