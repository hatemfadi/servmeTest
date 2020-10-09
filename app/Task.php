<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table='task';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name", "description", "datetime", "status", "category"
    ];
    protected $hidden   = ['created_at', 'updated_at'];

}
