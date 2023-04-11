<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurriculoController extends Controller
{
    public function Show(Request $request) {
        return view('curriculo.show');
    }
}
