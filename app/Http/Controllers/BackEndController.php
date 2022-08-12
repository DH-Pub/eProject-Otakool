<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BackEndController extends Controller
{
    public function index(){
        return view('be.index');
    }
}
