<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class UserController extends Controller
{
    public function show_register()
    {
        return view("register");
    }

    public function register(Request $request)
    {
        $c = new User();

        $input = $request->all();

//        return  $input;


        $rules = [
            "first_name" => "required|min:2",
            "last_name" => "required|min:2",
            "gender" => "required",
            "location" => "required|min:2",
            "address" => "required|min:2",
            "email" => "required|unique:users",
            "telephone" => "required|unique:users",
            "password" => "required|min:6|same:cpassword"
        ];

        $this->validate($request, $rules);

        $npass = bcrypt($input['password']);

        $c->add($input['first_name'], $input["last_name"], $input["gender"], $input["location"], $input["address"], $input["email"], $input["telephone"], $npass);

        return redirect('/')->with("status1", "Sign up successful");
    }

    public function login(Request $request)
    {

        $rules = [
            "email" => "required",
            "password" => "required"
        ];

        $this->validate($request, $rules);

        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with("status", "Your credentials do not match our records");
        }
    }

    public function show_dashboard()
    {
        return view('dashboard');
    }

    public function show_add_funeral()
    {
        return view('add_funeral');
    }

    public function add_funeral(Request $request)
    {
        $input = $request->all();

//        return $input['wk'];
        $rules = [
            'wk' => 'required',
            'name' => 'required|min:2',
            'deceased_name' => 'required|min:2',
            'age' => 'required|numeric|min:1',
            'brochure' => "required",
            'time' => "required",
            'location' => 'required|min:2',
            'date' => 'required|date|after:today',
            'attire' => 'required|min:2',
            'wake_keeping_date' => 'nullable|required_if:wk,1|date|after:today',
            'wake_keeping_time' => 'nullable|required_if:wk,1|min:6',
            'wake_keeping_location' => 'nullable|required_if:wk,1|min:2',
            'information' => "required",
            'latitude' => "required|numeric",
            'longitude' => 'required|numeric',
        ];

        $this->validate($request, $rules);

    }


}
