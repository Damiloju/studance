<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use SoftDeletes;

    protected $fillable = ['student_id','event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function student ()
    {
        return $this->belongsTo(Student::class);
    }
}
