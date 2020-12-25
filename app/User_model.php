<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User_model extends Model
{
    public function login($username)
    {
        $query = DB::table('users')
            ->select('users.*','role.name as role_name')
            ->where(array('users.username'	=> $username))
            ->join('role','role.id','=','users.role')
            ->orderBy('id','DESC')
            ->first();
        return $query;
    }
	
    public function cek_pengawas($id)
    {
        $query = DB::table('p_pengawas_assigns')
            ->select('*')
            ->where(array('p_pengawas_assigns.pengawas'	=> $id))
            ->orderBy('id','DESC')
            ->first();
        return $query;
    }
}
