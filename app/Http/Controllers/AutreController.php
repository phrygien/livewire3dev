<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutreController extends Controller
{
    public function commune()
    {
        return view('autres.commune');
    }
}
