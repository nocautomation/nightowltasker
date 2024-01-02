<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class OrderOuts extends Model
{
    protected $table = 'orderouts';

    protected $fillable = [
        'id',
        'loan',
        'orderouts_name',
        'first',
        'second',
        'third',
        'status',
        'remarks',
    ];

    public static function neworderout($neworderout){
        DB::table('orderouts')
                ->insert([
                    'loan' => $neworderout['loan'],
                    'orderouts_name' => $neworderout['orderouts_name'],
                    'first' => $neworderout['first'],
                    'second' => $neworderout['second'],
                    'third' => $neworderout['third'],
                    'status' => $neworderout['status'],
                    'remarks' => $neworderout['remarks'],
                    
            ]);
    }

    public static function updateorcreateorderout($neworderout){
        DB::table('orderouts')
                ->updateOrInsert(
                    [
                        'orderouts_name' => $neworderout['orderouts_name'], 
                        'loan' => $neworderout['loan']
                    ],
                    [
                        'first' => $neworderout['first'],
                        'second' => $neworderout['second'],
                        'third' => $neworderout['third'],
                        'status' => $neworderout['status'],
                        'remarks' => $neworderout['remarks']
                    ]
                );
    }

    public static function updateStatus($data){
        DB::table('orderouts')
            ->where('id',$data['id'])
            ->update([
                'status' => $data['status']
            ]);
    }
}
