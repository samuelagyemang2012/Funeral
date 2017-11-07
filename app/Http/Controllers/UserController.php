<?php

namespace App\Http\Controllers;

use App\Funeral;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
        $f = new Funeral();
        $auth = Auth::user();

        $name = $auth['first_name'] . ' ' . $auth['last_name'];

        $data = $f->get_funeral($auth['id']);

        $num = $f->num_funerals($auth['id']);

        return view('dashboard')->with('name', $name)->with('data', $data)->with('num', $num);
    }

    public function show_add_funeral()
    {
        return view('add_funeral');
    }

    public function add_funeral(Request $request)
    {
        $input = $request->all();

        $f = new Funeral();
        $id = Auth::user()->id;

        $file = '';
        $file_name = '';

        $rules = [
            'wk' => 'required',
            'name' => 'required|min:2',
            'deceased_name' => 'required|min:2',
            'age' => 'required|numeric|min:1',
            'information' => 'required',
            'brochure' => "required",
            'funeral_time' => "required",
            'funeral_location' => 'required|min:2',
            'funeral_date' => 'required|date|after:today',
            'attire' => 'required|min:2',
            'wake_keeping_date' => 'nullable|required_if:wk,1|date|after:today',
            'wake_keeping_time' => 'nullable|required_if:wk,1',
            'wake_keeping_location' => 'nullable|required_if:wk,1|min:2',
            'latitude' => "required|numeric",
            'longitude' => 'required|numeric',
        ];

        $this->validate($request, $rules);


        if (Input::hasFile('brochure')) {

            $file = Input::file('brochure');
            $file->move('uploads', $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();

        }

        if ($input['wk'] == 0) {
            $f->add($id, $input['name'], $input['deceased_name'], $input['age'], $input['information'], $file_name, $input['funeral_location'], $input['longitude'], $input['latitude'], $input['attire'], $input['funeral_date'], $input['funeral_time'], $input['wk'], 'none', 'none', 'none');
            return redirect('/dashboard')->with('status', 'Funeral added successfully');
        } else {
            $f->add($id, $input['name'], $input['deceased_name'], $input['age'], $input['information'], $file_name, $input['funeral_location'], $input['longitude'], $input['latitude'], $input['attire'], $input['funeral_date'], $input['funeral_time'], $input['wk'], $input['wake_keeping_date'], $input['wake_keeping_time'], $input['wake_keeping_location']);
            return redirect('/dashboard')->with('status', 'Funeral added successfully');
        }

    }

    public function show_make_poster()
    {
        return view('make_poster');
    }


}
