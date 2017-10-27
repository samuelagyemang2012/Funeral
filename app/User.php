<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    //
    public function add($fname, $lname, $gender, $location, $address, $email, $telephone, $password)
    {
        $id = DB::table('users')->insertGetId(
            ['first_name' => $fname,
                'last_name' => $lname,
                'gender' => $gender,
                'location' => $location,
                'address' => $address,
                'email' => $email,
                'telephone' => $telephone,
                'password' => $password,
            ]);
    }
}
