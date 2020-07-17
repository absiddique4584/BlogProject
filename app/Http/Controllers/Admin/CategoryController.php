<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{



    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
      $categories = Category::select('id','name','slug','status')->orderBy('id','asc')->paginate(5);
        return view('admin.category.manage', compact('categories'));
    }




    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.category.create');
    }




    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'status' => 'required',
        ],[
            'name.required' => 'The Category Field Is Required !',
        ]);
        Category::create([
           'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
            'status'=>$request->status,
        ]);
        $this->showMessage('Category Save Success','success');
        return redirect()->back();
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
    public function edit($slug, $id)
    {
        $category = Category::with('posts')->select('id','name','status')->find($id);
        return view('admin.category.edit', compact('category'));
    }





    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'status' => 'required',
        ]);
        $category = Category::find($id);

        $category->update([
            'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
            'status'=>$request->status,
        ]);
        $this->showMessage('Category Update Success !','success');
        return redirect()->back();
    }





    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        $this->showMessage('Category Deleted Success','success');
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
