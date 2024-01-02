<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'id',
        'loan',
        'task_name',
        'start',
        'end'
    ];

    public static function newtask($newtask){
        DB::table('tasks')
                ->insert([
                    'task_name' => $newtask['task_name'],
                    'loan' => $newtask['loanid'],
                    'start' => $newtask['start'],
                    'end' => $newtask['end']
            ]);
    }

    public static function updateorcreatetask($newtask){
        DB::table('tasks')
                ->updateOrInsert(
                    [
                        'task_name' => $newtask['task_name'], 
                        'loan' => $newtask['loanid']
                    ],
                    [
                        'start' => $newtask['start'],
                        'end' => $newtask['end']
                    ]
                );
    }

    public static function completeTask($data,$now){
        DB::table('tasks')
            ->where('id',$data['id'])
            ->update([
                'end' => $now
            ]);
            
            
    }
}
