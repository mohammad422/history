<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function contact()
    {
        return view('contact');
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name'=>'required|max:100|min:7',
            'email'=>'required|email',
            'body'=>'required|max:500|min:30'
        ]);
        Contact::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'body' => $request['body']
        ]);
        return redirect('/contact')->with('message','پیام شما با موفقیت ارسال شد.');
    }


}
