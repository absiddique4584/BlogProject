<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class WebsiteController extends Controller
{
    public function index()
    {
        $categories = Category::where('status',1)->get();
        return view('home',compact('categories'));
    }

    public function post($id)
    {
        $categories = Category::where('status',1)->get();
       $post = Post::where('id',$id)->first();
        return view('post', compact('categories','post'));
    }

    public function category($slug){
        $id = Category::where('slug',$slug)->select('id')->first();
        $categories = Category::where('status',1)->get();
        $posts = Category::with('posts')->find($id->id);
       return view('category',compact('categories','posts'));
    }

    public function posts($date){
        $categories = Category::where('status',1)->get();

        $posts = Post::with('category','user')
            ->where('created_at','LIKE','%'. $date . '%')
            ->where('status','published')
            ->orderBy('id','DESC')
            ->paginate('5');
        return view('posts',compact('categories','posts'));
    }

}
