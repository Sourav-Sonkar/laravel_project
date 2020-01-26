<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ATGuser;
use Validator, Redirect, Response;

class WebServicesController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'pincode' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6|max:6'
        ]);
        if ($validator->passes()) {
            $posts = ATGuser::where('email', $request->email)->get();
            $post1 = ATGuser::where('name', $request->name)->get();
            if (count($posts) > 0) {
                return response()->json(array('mess' => 'Email exist', 'status' => false));
            } else if (count($post1) > 0) {
                return response()->json(array('mess' => 'Name exist', 'status' => false));
            } else {
                $atguser = new ATGuser();
                $atguser->name = $request->input('name');
                $atguser->email = $request->input('email');
                $atguser->pincode = $request->input('pincode');
                $atguser->save();
                return response()->json(array('mess' => 'Data Stored', 'status' => true));
            }
        }else{
            return response()->json(array('mess' => 'Invalid Format', 'status' => false));
        }
    }
}
