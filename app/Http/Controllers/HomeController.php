<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Models\Comment;

class HomeController extends Controller
{
    public function Index(){
        $blogPosts = BlogPost::latest()->limit(3)->where('status', 1)->get();
        return view('layouts.index',compact('blogPosts'));
    }





    public function ShowAllBlogPost(){
        $blogPosts = BlogPost::latest()->where('status', 1)->paginate(20);
        return view('layouts.blog',compact('blogPosts'));
    }








    public function ViewPostDetails($slug){
        $postDetails = BlogPost::where('slug', $slug)->get();

        $id = BlogPost::where('slug', $slug)->value('id');
        $comments =Comment::latest()->where('blog_id', $id)->where('status', 1)->get();
        return view('layouts.blog-details', compact('postDetails','comments'));
    }












    public function CommentStore(Request $request, $id){


        $validation = $request->validate([
            'first_name' => 'required',
            'message'=>'required'
        ]);


        $comments = new Comment();

        $comments->blog_id = $id;
        $comments->email = $request->email;
        $comments->first_name = $request->first_name;
        $comments->last_name = $request->last_name;
        $comments->message = $request->message;
        $comments->status = 0;

        $comments->save();
        if ( $comments == true ){
            $notifications = alert()->success('SuccessAlert','Thank you for you valuable comment.');
            return redirect()->back();
        }else{
            $notifications = alert()->error('ErrorAlert','Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }




}
