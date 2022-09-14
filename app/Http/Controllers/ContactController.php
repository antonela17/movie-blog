<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController
{
    public function create()
    {
        $categories = Categories::all()->toArray();

        return view('contact')->with(compact('categories'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'subject' => 'required|min:10|max:300',
            'message' => 'required|min: 20'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        try {
            Mail::to($data['email'])->send(new ContactEmail($data));
            return redirect()->back()->with('success','Your message has been sent. Thank you!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Email sent successfully');
        }
    }


}
