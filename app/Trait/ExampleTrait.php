<?php

namespace AppTraits;

use App\ATGuser;
use Mail;

trait ExampleCode
{
    public function savedata($request)
    {
        $atguser = new ATGuser();
        $atguser->name = $request->input('name');
        $atguser->email = $request->input('email');
        $atguser->pincode = $request->input('pincode');
        $atguser->save();
    }

    public function sendMail($request)
    {
        Mail::send(['text' => 'mail'], ['name' => 'Sourav'], function ($message) use ($request) {
            $message->to($request->email,$request->name)->subject("Test email");
            $message->from("jippityservice@gmail.com", 'Sourav');
        });
        
    }
}
