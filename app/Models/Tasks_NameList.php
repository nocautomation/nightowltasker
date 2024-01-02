<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Tasks_NameList extends Model
{
    protected $table = 'tasks_namelist';

    protected $fillable = [
        'tasklistId',
        'taskName',
        'date_created',
    ];

    public static function insertTaskType($data){
        DB::table('tasks_namelist')
            ->insert([
                'taskName' => $data['taskName'],
            ]);
    }

    public static function editTaskType($data){
        DB::table('tasks_namelist')
            ->where('tasklistId',$data['tasklistId'])
            ->update([
                'taskName' => $data['taskName'],
            ]);
    }

    public static function DeleteTaskType($data){

        DB::table('tasks_namelist')
            ->where('tasklistId',$data['id'])
            ->delete();
    }

}
