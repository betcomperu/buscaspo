<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
 
    
    public function index()
    {
        //Llenamos la Data
        $data = [
            'titulo' => 'Home'       
        ]   ;
        return view('Admin/Home/index',$data);
    }
   
}
