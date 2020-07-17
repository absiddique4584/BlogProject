<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;
use Exception;
class AuthController extends Controller
{

    public function registerForm()
    {
        $categories = Category::where('status',1)->get();
        return view('register-form',compact('categories'));
    }

    public function register(RegisterRequest $request)
    {

        try {
            $image    = $request->file('image');
            $fileName = rand(0, 999999999) . '_' . date('Ymdhis') . '_' . rand(99999, 999999999) . '.' . $image->getClientOriginalExtension();
            if ($image->isValid()) {
                if ($image->getMimeType() === "image/png" || $image->getMimeType() === "image/jpeg") {
                    $image->storeAs('users', $fileName);
                } else {
                    $this->showMessage("Something wrong !","danger");
                    return redirect()->back();
                }
            }

            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
                'image'    => $fileName,
            ]);

            $this->showMessage("Data seve success!","success");
            return redirect()->back();
        } catch (Exception $Exception) {
            $this->showMessage("Something wrong!","danger");
            return redirect()->back();
        }

    }

   public function loginform()
    {
        $categories = Category::where('status',1)->get();
        return view('login-form',compact('categories'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ]);

        $data = $request->except('_token');
        if(auth()->attempt($data)){
            return redirect()->route('index');
        }

        $this->showMessage("Login error","danger");
        return redirect()->back();
    }

    public function logout(){
        auth()->logout();

        $this->showMessage("User has been logout.","success");
        return redirect()->route('login');
    }
}

