<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_name', 'author_id', 'title', "body"
    ];


    public function author()
    {
        return $this->hasOne("App\User", "id", "author_id");
    }
}
