<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoeManager extends Controller
{
    function addShoe(){
        return view('addShoe');
    }
}
