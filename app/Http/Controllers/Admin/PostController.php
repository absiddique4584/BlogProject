<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use mysql_xdevapi\Exception;

class PostController extends Controller
{



    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with('category','user')->paginate(5);
        return view('admin.post.manage',compact('posts'));
    }





    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('admin.post.create',compact('categories'));
    }





    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $image    = $request->file('thumbnail');
            $fileName = rand(0, 999999999) . '_' . date('Ymdhis') . '_' . rand(99999, 999999999) . '.' . $image->getClientOriginalExtension();
            if ($image->isValid()) {
                if ($image->getMimeType() === "image/png" || $image->getMimeType() === "image/jpeg") {
                    $image->storeAs('posts', $fileName);
                } else {
                    $this->showMessage("Something wrong !","danger");
                    return redirect()->back();
                }
            }

            $request->validate([
                'title' => 'required',
                'status' => 'required',
                'thumbnail' => 'required'
            ],[
                'name.required' => 'The Post Field Is Required !',
            ]);

            Post::create([
                'title'=>$request->title,
                'user_id'=>auth()->user()->id,
                'category_id'=>$request->category_id,
                'content'=>$request->post_content,
                'status'=>$request->status,
                'thumbnail'=> $fileName,

            ]);
            $this->showMessage('Post Save Success','success');
            return redirect()->back();
        }catch (Exception $exception){
            $this->showMessage("Something wrong!","danger");
            return redirect()->back();
        }
    }





    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }





    /**
     * @param $slug
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = Category::where('status',1)->get();
        $post = Post::find($id);
        return view('admin.post.edit', compact('post','categories'));
    }





    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $posts = Post::find($id);

        if ($request->file('thumbnail')){
            $image    = $request->file('thumbnail');
            $fileName = rand(0, 999999999) . '_' . date('Ymdhis') . '_' . rand(99999, 999999999) . '.' . $image->getClientOriginalExtension();
            if ($image->isValid()) {
                if ($image->getMimeType() === "image/png" || $image->getMimeType() === "image/jpeg") {
                    $image->storeAs('posts', $fileName);

                    unlink(public_path('uploads/posts/'.$posts->thumbnail));

                    $posts->update([
                        'thumbnail'=> $fileName
                    ]);
                } else {
                    $this->showMessage("Something wrong !","danger");
                    return redirect()->back();
                }
            }
        }

         $posts->update([
             'title'=>$request->title,
             'category_id'=>$request->category_id,
             'content'=>$request->post_content,
             'status'=>$request->status
         ]);

        $this->showMessage('Post Update Success !','success');
        return redirect()->back();
    }






    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $posts = Post::find($id);
            unlink(public_path('uploads/posts/'.$posts->thumbnail));
            $posts->delete();
            $this->showMessage('Posts Deleted Success','success');
        }catch (Exception $exception){

        }
        return redirect()->back();
    }






    /**
     * @param $text
     * @return string
     */

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
