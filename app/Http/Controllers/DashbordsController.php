<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashbordsController extends Controller
{
    public function TableauBord()
    {

        return view('dashboard.index');
    }
}
