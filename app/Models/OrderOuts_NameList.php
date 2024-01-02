<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class OrderOuts_NameList extends Model
{
    protected $table = 'orderouts_namelist';

    protected $fillable = [
        'namelistId',
        'orderoutName',
        'date_created',
    ];

    public static function insertOrderOutType($data){
        DB::table('orderouts_namelist')
            ->insert([
                'orderoutName' => $data['OrderOutName'],
            ]);
    }

    public static function editOrderOutType($data){
        DB::table('orderouts_namelist')
            ->where('namelistId',$data['orderoutnameID'])
            ->update([
                'orderoutName' => $data['OrderOutName'],
            ]);
    }

    public static function DeleteOrderOutType($data){

        DB::table('orderouts_namelist')
            ->where('namelistId',$data['id'])
            ->delete();
    }
}
