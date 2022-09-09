<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController
{
    public function sendMail()
    {
       Mail::to("fakw@gmail.com")->send(new ContactEmail());
       return view("email.test");
    }

}
