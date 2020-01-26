<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index(){
        $title="Welcome to laravel!";
        //2 ways of passing any parameter
        //1st way
        return view('pages.index',compact('title'));
        //return view('pages.index')->with('title',$title);
        
    }
    
}
