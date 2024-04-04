<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlertController extends Controller
{
    public function alert($message){
        Alert::alert('Title', $message, 'Type');
    }
}
