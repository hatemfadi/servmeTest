<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name", "description", "datetime", "status", "category", "user_id"
    ];
    protected $hidden = ['created_at', 'updated_at', 'user_id'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id','id');
    }
}
