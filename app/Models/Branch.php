<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Branch extends Model
{
    protected $table = 'branch';

    protected $fillable = [
        'id',
        'branch_name',
        'address',
        'contact_number',
        'date_created'
    ];

    public static function AddBranch($data){

        DB::table('branch')
            ->insert([
                'branch_name' => $data['branchName'],
                'address' => $data['addressName'],
                'contact_number' => $data['contact_number'],
                'overdue_interval' => $data['overdue_interval']
            ]);
    }

    public static function EditBranch($data){

        DB::table('branch')
            ->where('id', $data['branchid'])
            ->update([
                'branch_name' => $data['branchName'],
                'address' => $data['addressName'],
                'contact_number' => $data['contact_number'],
                'overdue_interval' => $data['overdue_interval']
            ]);
    }

    public static function DeleteBranch($data){
        DB::table('branch')
            ->where('id',$data['id'])
            ->delete();
    }
}
