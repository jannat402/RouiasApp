<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() { 
        // redirigimos al listado del catálogo 
        return redirect('catalog'); 
    }
}
