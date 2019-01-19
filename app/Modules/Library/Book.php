<?php

namespace App\Modules\Library;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Book extends Model
{
    use Notifiable;

    protected $primaryKey  = 'book_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id', 'book_name', 'book_publisher', 'book_year', 'book_language', 'book_pages',
    ];

    public function authors()
    {
        return $this->belongsToMany('App\Modules\Library\Author', 'book_authors', 'book_id', 'author_id')->withTimestamps();
    }

    public function dailies()
    {
        return $this->hasMany('App\Modules\Library\Daily', 'daily_id');
    }
}
