<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required',
            'message' => 'required',
        ]);

        return response()->json('Email successfully send!');
    }
}
