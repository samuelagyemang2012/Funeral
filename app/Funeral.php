<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funeral extends Authenticatable
{
    //
    public function add($user_id, $name, $dn, $da, $info, $brochure, $fl, $longitude, $latitude, $attire, $date, $time, $wk, $wkd, $wkt, $wkl)
    {
        $id = DB::table('users')->insertGetId(
            ['user_id' => $user_id,
                'name' => $name,
                'deceased_name' => $dn,
                'deceased_age' => $da,
                'information' => $info,
                'brochure' => $brochure,
                'funeral_location' => $fl,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'attire' => $attire,
                'date' => $date,
                'time' => $time,
                'wake_keeping' => $wk,
                'wake_keeping_date' => $wkd,
                'wake_keeping_time' => $wkt,
                'wake_keeping_location' => $wkl
            ]);
    }
}
