<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoe;

class ShoeManager extends Controller
{
    function addShoe(){
        return view('addShoe');
    }
    function addShoePost(Request $request){
        $request->validate([
            'model' => 'required',
            'size' => 'required', 
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
