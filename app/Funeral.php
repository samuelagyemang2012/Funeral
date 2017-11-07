<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Funeral extends Authenticatable
{
    //
    public function add($user_id, $name, $dn, $da, $info, $brochure, $fl, $longitude, $latitude, $attire, $date, $time, $wk, $wkd, $wkt, $wkl)
    {
        $id = DB::table('funerals')->insertGetId(
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

    public function get_funeral($id)
    {
        return DB::table('funerals')
            ->where('user_id', '=', $id)
            ->paginate(1);
    }

    public function num_funerals($id)
    {
        return DB::table('funerals')->where('user_id','=',$id)->count();
    }
}
