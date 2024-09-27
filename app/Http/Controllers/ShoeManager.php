<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoeManager extends Controller
{
    function addShoe(){
        return view('addShoe');
    }
    function addShoePost(request $request){
        $request->validate([
            'model' => 'required',
            'size' => 'required', // email verifica se é um email válido @xxxx.com 
            'color' => 'required',
        ]);

        $data['model'] = $request->model;
        $data['size'] = $request->size;
        $data['color'] = $request->color;
;

        $shoe = Shoe::create($data);

        if(!$shoe){
            return redirect(route('addShoe'))->with("error", "Registration failed try again.");
        }
        return redirect(route('addShoe'))->with("success", "Registration completed, login to access the website");
        
        
    }
}
