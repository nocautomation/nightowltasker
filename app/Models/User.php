<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email_address',
        'password',
        'branch',
        'user_type',
        'status',
        'avatar',
        'date_created'
    ];

    public static function AddUser($data){

        if(!empty($data['avatar'])){

            $file = $data->file('avatar')->getClientOriginalName();

            DB::table('user')
                ->insert([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'branch' => $data['branch'],
                    'user_type' => $data['userrole'],
                    'avatar' => $file
            ]);
        }
        else{
            DB::table('user')
                ->insert([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'branch' => $data['branch'],
                    'user_type' => $data['userrole'],
            ]);
        }
        
    }

    public static function EditUser($data){

        if(!empty($data['avatar'])){

            $file = $data->file('avatar')->getClientOriginalName();

            DB::table('user')
            ->where('id', $data['userid'])
            ->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'branch' => $data['branch'],
                'user_type' => $data['userrole'],
                'avatar' => $file
            ]);
        }
        else{
            DB::table('user')
            ->where('id', $data['userid'])
            ->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'branch' => $data['branch'],
                'user_type' => $data['userrole'],
            ]);
        }

        
    }

    public static function DeleteUser($data){
        DB::table('user')
            ->where('id',$data['id'])
            ->delete();
    }
}
