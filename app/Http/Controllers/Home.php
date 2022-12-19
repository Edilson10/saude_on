<?php

namespace App\Http\Controllers;

use App\Classes\HomeClass;
use Illuminate\Http\Request;

class Home extends Controller
{
    private $home;

    public function __construct()
    {
        $this->home = new HomeClass();
    }

    //================================
    public function home(Request $request)
    {
        return view('index');
    }
}
