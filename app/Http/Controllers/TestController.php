<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function post(){
        return 'post list function';
    }

    public function comments(){
        return 'comments list function';
    }
}
