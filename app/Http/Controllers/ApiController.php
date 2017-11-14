<?php

namespace App\Http\Controllers;

use App\Funeral;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $c = new User();

        $input = $request->all();

        $rules = [
            "first_name" => "required|min:2",
            "last_name" => "required|min:2",
            "gender" => "required",
            "location" => "required|min:2",
            "address" => "required|min:2",
            "email" => "required|email|unique:users",
            "telephone" => "required|unique:users",
            "password" => "required|min:6"
        ];

        $messages = [
            "first_name.required" => "first_name is required; minimum: 2 characters",
            "first_name.min" => "first_name must have a  minimum of 2 characters",

            "last_name.required" => "last_name is required; minimum: 2 characters",
            "last_name.min" => "last_name must have a  minimum of 2 characters",

            "gender.required" => "gender is required MALE/FEMALE",

            "location.required" => "location is required; minimum: 2 characters",
            "location.min" => "location must have a  minimum of 2 characters",

            "address.required" => "address is required; minimum: 2 characters",
            "address.min" => "address must have a  minimum of 2 characters",

            "email.required" => "email is required",
            "email.email" => "A valid email is required",
            "email.unique" => "This email already exists",

            "telephone.required" => "telephone is required",
            "telephone.unique" => "This telephone already exists",

            "password.required" => "password already exists",
            "password.min" => "password must have a minimum of 6 characters"

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $somearray = array();

        if ($validator->fails()) {

            foreach ($validator->errors()->all() as $messages) {
                array_push($somearray, $messages . "\r\n");
            }

            return response()->json([
                "code" => '400',
                "msg" => $somearray
            ]);
        }

        $npass = bcrypt($input['password']);

        $c->add($input['first_name'], $input["last_name"], $input["gender"], $input["location"], $input["address"], $input["email"], $input["telephone"], $npass);

        return response()->json([
            "code" => 0,
            "msg" => "Registration successful"
        ]);
    }

    public function login(Request $request)
    {
        $rules = [
            "email" => "required",
            "password" => "required"
        ];

        $messages = [
            "email.required" => "email is required",
            "password" => "password is required"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $somearray = array();

        if ($validator->fails()) {

            foreach ($validator->errors()->all() as $messages) {
                array_push($somearray, $messages . "\r\n");
            }

            return response()->json([
                "code" => '400',
                "msg" => $somearray
            ]);
        }


        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {

            $user_data = Auth::user();

            return response()->json([
                "code" => 0,
                "user_id" => $user_data['id'],
                "msg" => "Login successful"
            ]);

        } else {

            return response()->json([
                "code" => 400,
                "msg" => "Login failed"
            ]);
        }
    }

    public function get_funerals(Request $request)
    {
        $f = new Funeral();

        if (empty($request->user_id)) {
            return response()->json([
                "code" => 400,
                "msg" => "user_id is required"
            ]);
        }

        $data = $f->get_user_funerals($request->user_id);


        $num = $f->num_funerals($request->user_id);

        return response()->json([
            "code" => 0,
            "funeral_count" => $num,
            "funerals" => $data
        ]);
    }

    public function add_funeral(Request $request)
    {
        $input = $request->all();

        $f = new Funeral();
        $id = Auth::user()->id;

        $file = '';
        $file_name = '';

        $rules = [
            'haswakeeping' => 'required',
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

        $message = [
            "haswakekeeping.required" => "specify is there is a wake-keeping. 1 for yes, 0 for no",
            "name.required"=>"title of funeral is required",
            "name.min"=>"tile of funeral must have a minimum of 2 caharacters"
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

    public function update_funeral(Request $request)
    {
//        return $request;
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
            'brochure' => "nullable",
            'funeral_time' => "required",
            'funeral_location' => 'required|min:2',
            'funeral_date' => 'required|date',
            'attire' => 'required|min:2',
            'wake_keeping_date' => 'nullable|required_if:wk,1|date',
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
            $f->update_brochure($input['id'], $file_name);
        }

        if ($input['wk'] == 0) {
            $f->update_funeral($input['id'], $input['name'], $input['deceased_name'], $input['age'], $input['information'], $file_name, $input['funeral_location'], $input['longitude'], $input['latitude'], $input['attire'], $input['funeral_date'], $input['funeral_time'], $input['wk'], 'none', 'none', 'none');
            return redirect('/dashboard')->with('status', 'Funeral updated successfully');
        } else {
            $f->update_funeral($input['id'], $input['name'], $input['deceased_name'], $input['age'], $input['information'], $file_name, $input['funeral_location'], $input['longitude'], $input['latitude'], $input['attire'], $input['funeral_date'], $input['funeral_time'], $input['wk'], $input['wake_keeping_date'], $input['wake_keeping_time'], $input['wake_keeping_location']);

            return redirect('/dashboard')->with('status', 'Funeral updated successfully');
        }
    }

    public function delete_funeral(Request $request)
    {
        $f = new Funeral();

        $date = date('Y-m-d H:i:s');

        $id = $request->id;

        $f->delete_funeral($id, $date);

        return redirect('/dashboard')->with('status', 'Funeral deleted');

    }

}
