<?php

namespace App\Modules\Library;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class Daily extends Model
{
    use Notifiable;

    protected $primaryKey  = 'daily_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'daily_id', 'book_id', 'daily_description', 'daily_time_start', 'daily_time_end',
    ];



    public function getDailyTimeStartAttribute($value)
    {
        $date = null;
        if (isset($value)) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('m/d/Y  H:i:s');
        }
        return $date;
    }

    public function setDailyTimeStartAttribute($value)
    {
        $this->attributes['daily_time_start'] = null;

        if (isset($value) && $value) {
            $this->attributes['daily_time_start'] = Carbon::createFromFormat('m/d/Y  H:i:s', $value)->format('Y-m-d  H:i:s');
        }

    }

    public function getDailyTimeEndAttribute($value)
    {
        $date = null;

        if (isset($value)) {
            $date = Carbon::createFromFormat('Y-m-d  H:i:s', $value)->format('m/d/Y  H:i:s');
        }
        return $date;
    }

    public function setDailyTimeEndAttribute($value)
    {
        $this->attributes['daily_time_end'] = null;

        if (isset($value) && $value) {
            $this->attributes['daily_time_end'] = Carbon::createFromFormat('m/d/Y  H:i:s', $value)->format('Y-m-d  H:i:s');
        }
    }


    public function books()
    {
        return $this->belongsTo('App\Modules\Library\Book', 'book_id');
    }
}
