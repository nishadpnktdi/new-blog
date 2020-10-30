<?php

namespace App\Http\Controllers;

use App\Jobs\SendAdminMailJob;
use App\Jobs\SendUserMailJob;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','DESC')->simplePaginate(1);

        return view('/blog/content')->with(compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        
        return view('/blog/post')->with(compact('post'));
    }

    public function about()
    {
        return view('/blog/about');
    }

    public function contact()
    {
        return view('/blog/contact');
    }

    public function contactForm(Request $request)
    {

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        $contact->save();

        dispatch(new SendUserMailJob($contact));
        dispatch(new SendAdminMailJob($contact));
        
        return back()->with('message', 'success');
    }
}
