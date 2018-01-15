<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['session','semester','event','active'];


    public function record ()
    {
        return $this->hasMany(Record::class);
    }
}
