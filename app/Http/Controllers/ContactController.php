<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function manage_contacts(){
        return view('manage_contacts');      
    }
}
