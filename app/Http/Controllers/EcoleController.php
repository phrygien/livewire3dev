<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcoleController extends Controller
{
    public function ecole()
    {
        return view('ecoles.index');
    }
}
