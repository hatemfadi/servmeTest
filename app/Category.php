<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name", "user_id"
    ];

    protected $hidden = ['created_at', 'updated_at', 'user_id'];

    public function tasks()
    {
        return $this->hasMany('App\Task', 'category_id','id');
    }
}
