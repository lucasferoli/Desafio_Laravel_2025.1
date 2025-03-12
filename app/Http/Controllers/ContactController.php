<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    public function store()
    {
    Mail::to('lucasferoliveira.goval@gmail.com', 'lucas')->send(new Contact);
    }
}
