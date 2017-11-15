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
                array_push($somearray, $messages . PHP_EOL);
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
            "password.required" => "password is required"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $somearray = array();

        if ($validator->fails()) {

            foreach ($validator->errors()->all() as $messages) {
                array_push($somearray, $messages . PHP_EOL);
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

        $data = $f->get_user_funerals_api($request->user_id);


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
        $data = Auth::id();
        $id = Auth::user();

        return $data;

        $file = '';
        $file_name = '';

        $rules = [
            'has_wake_keeping' => 'required',
            'name' => 'required|min:2',
            'deceased_name' => 'required|min:2',
            'age' => 'required|numeric|min:1',
            'information' => 'required',
            'brochure' => "required",
            'funeral_time' => "required",
            'funeral_location' => 'required|min:2',
            'funeral_date' => 'required|date|after:today',
            'attire' => 'required|min:2',
            'wake_keeping_date' => 'nullable|required_if:has_wake_keeping,1|date|after:today',
            'wake_keeping_time' => 'nullable|required_if:has_wake_keeping,1|min:2',
            'wake_keeping_location' => 'nullable|required_if:has_wake_keeping,1|min:2',
            'latitude' => "required|numeric",
            'longitude' => 'required|numeric',
        ];

        $message = [
            "has_wake_keeping.required" => "specify if there is a wake-keeping. 1 for yes, 0 for no",
            "name.required" => "title of funeral is required",
            "deceased_name.required" => "deceased_name is required",
            "deceased_name.min" => "deceased_name must have a minimum of 2 characters",
            "name.min" => "title of funeral must have a minimum of 2 characters",
            "age.required" => "age of deceased is required",
            "age.numeric" => "age must be a number",
            "age.min" => "age must be a minimum of 1 year",
            "information.required" => "information about the funeral is required",
            "brochure.required" => "brochure is required",
            "funeral_time.required" => "funeral_time is required",
            "funeral_location.required" => "funeral_location is required",
            "funeral_location.min" => "funeral_location must have a minimum of 2 characters",
            "funeral_date.required" => "funeral_date is required",
            "funeral_date.date" => "funeral_date must be a date",
            "funeral_date.after" => "funeral_date must be a date after today",
            "attire.required" => "attire is required",
            "attire.min" => "attire must have a minimum of 2 characters",
            "wake_keeping_date.required_if" => "wake_keeping_date is required if has_wake_keeping is 1",
            "wake_keeping_date.date" => "wake_keeping_date must be a date",
            "wake_keeping_date.after" => "wake_keeping_date must be a date after today",
            "wake_keeping_time.required_if" => "wake_keeping_time is required if has_wake_keeping is 1",
            "wake_keeping_time.min" => "wake_keeping_time must have a minimum of 2 characters",
            "wake_keeping_location.required_if" => "wake_keeping_location is required if has_wake_keeping_time is 1",
            "wake_keeping_location.min" => "wake_keeping_location must have a minimum of 2 characters",
            "latitude.required" => "latitude is required",
            "latitude.numeric" => "latitude must be a number",
            "longitude.required" => "longitude is required",
            "longitude.numeric" => "longitude must be a number"
        ];

        $validator = Validator::make($request->all(), $rules, $message);

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

        if ($input['has_wake_keeping'] != 0 || $input['has_wake_keeping'] != 1) {
            return response()->json(
                [
                    "code" => "400",
                    "msg" => "has_wake_keeping can either be 1 or 0. 1 for yes, 0 for no"
                ]);
        }

        if (Input::hasFile('brochure')) {

            $file = Input::file('brochure');
            $file->move('uploads', $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
        }

        if ($input['has_wake_keeping'] == 0) {

            $f->add($id, $input['name'], $input['deceased_name'], $input['age'], $input['information'], $file_name, $input['funeral_location'], $input['longitude'], $input['latitude'], $input['attire'], $input['funeral_date'], $input['funeral_time'], $input['has_wake_keeping'], 'none', 'none', 'none');

            return response()->json(
                [
                    "code" => "0",
                    "msg" => "Funeral added successfully"
                ]);

        } else {

            $f->add($id, $input['name'], $input['deceased_name'], $input['age'], $input['information'], $file_name, $input['funeral_location'], $input['longitude'], $input['latitude'], $input['attire'], $input['funeral_date'], $input['funeral_time'], $input['has_wake_keeping'], $input['wake_keeping_date'], $input['wake_keeping_time'], $input['wake_keeping_location']);

            return response()->json(
                [
                    "code" => "0",
                    "msg" => "Funeral added successfully"
                ]);
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
            'has_wake_keeping' => 'required',
            'name' => 'required|min:2',
            'deceased_name' => 'required|min:2',
            'age' => 'required|numeric|min:1',
            'information' => 'required',
            'brochure' => "nullable",
            'funeral_time' => "required",
            'funeral_location' => 'required|min:2',
            'funeral_date' => 'required|date',
            'attire' => 'required|min:2',
            'wake_keeping_date' => 'nullable|required_if:has_wake_keeping,1|date',
            'wake_keeping_time' => 'nullable|required_if:has_wake_keeping,1|min:2',
            'wake_keeping_location' => 'nullable|required_if:has_wake_keeping,1|min:2',
            'latitude' => "required|numeric",
            'longitude' => 'required|numeric',
        ];

        $message = [
            "has_wake_keeping.required" => "specify if there is a wake-keeping. 1 for yes, 0 for no",
            "name.required" => "title of funeral is required",
            "name.min" => "title of funeral must have a minimum of 2 characters",
            "deceased_name.required" => "deceased_name  must have a minimum of 2 characters",
            "deceased_name.min" => "deceased_name is required",
            "age.required" => "age of deceased is required",
            "age.numeric" => "age must be a number",
            "age.min" => "age must be a minimum of 1 year",
            "information.required" => "information about the funeral is required",
            "funeral_time.required" => "funeral_time is required",
            "funeral_location.required" => "funeral_location is required",
            "funeral_location.min" => "funeral_location must have a minimum of 2 characters",
            "funeral_date.required" => "funeral_date is required",
            "funeral_date.date" => "funeral_date must be a date",
            "attire.required" => "attire is required",
            "attire.min" => "attire must have a minimum of 2 characters",
            "wake_keeping_date.required_if" => "wake_keeping_date is required if has_wake_keeping is 1",
            "wake_keeping_date.date" => "wake_keeping_date must be a date",
            "wake_keeping_time.required_if" => "wake_keeping_time is required if has_wake_keeping is 1",
            "wake_keeping_time.min" => "wake_keeping_time must have a minimum of 2 characters",
            "wake_keeping_location.required_if" => "wake_keeping_location is required if has_wake_keeping_time is 1",
            "wake_keeping_location.min" => "wake_keeping_location must have a minimum of 2 characters",
            "latitude.required" => "latitude is required",
            "latitude.numeric" => "latitude must be a number",
            "longitude.required" => "longitude is required",
            "longitude.numeric" => "longitude must be a number"
        ];

        $validator = Validator::make($request->all(), $rules, $message);

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

        if (Input::hasFile('brochure')) {

            $file = Input::file('brochure');
            $file->move('uploads', $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $f->update_brochure($input['id'], $file_name);
        }

        if ($input['has_wake_keeping'] == 0) {

            $f->update_funeral($input['id'], $input['name'], $input['deceased_name'], $input['age'], $input['information'], $file_name, $input['funeral_location'], $input['longitude'], $input['latitude'], $input['attire'], $input['funeral_date'], $input['funeral_time'], $input['has_wake_keeping'], 'none', 'none', 'none');

            return response()->json(
                [
                    "code" => "0",
                    "msg" => "Funeral added successfully"
                ]);

        } else {

            $f->update_funeral($input['id'], $input['name'], $input['deceased_name'], $input['age'], $input['information'], $file_name, $input['funeral_location'], $input['longitude'], $input['latitude'], $input['attire'], $input['funeral_date'], $input['funeral_time'], $input['has_wake_keeping'], $input['wake_keeping_date'], $input['wake_keeping_time'], $input['wake_keeping_location']);

            return response()->json(
                [
                    "code" => "0",
                    "msg" => "Funeral added successfully"
                ]);
        }
    }

    public function delete_funeral(Request $request)
    {
        $f = new Funeral();

        $date = date('Y-m-d H:i:s');

        $id = $request->id;

        if (empty($id)) {
            return response()->json(
                [
                    "code" => "400",
                    "msg" => "id is required"
                ]);
        }

        $f->delete_funeral($id, $date);

        return response()->json(
            [
                "code" => "0",
                "msg" => "Funeral added successfully"
            ]);
    }
}
