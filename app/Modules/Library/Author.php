<?php

namespace App\Modules\Library;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class Author extends Model
{
    use Notifiable;

    protected $primaryKey  = 'author_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id', 'author_name', 'author_birthday',
    ];


    public function getAuthorBirthdayAttribute($value)
    {
        $date = null;

        if (isset($value)) {
            $date = Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
        }
        return $date;
    }

    public function setAuthorBirthdayAttribute($value)
    {
        $this->attributes['author_birthday'] = null;

        if (isset($value) && $value) {
            $this->attributes['author_birthday'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
        }
    }


    public function books()
    {
        return $this->belongsToMany('App\Modules\Library\Book', 'book_authors', 'author_id', 'book_id')->withTimestamps();
    }

}
