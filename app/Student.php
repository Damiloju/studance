<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','level','matric_number','photo','temp_number','program_id'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function record()
    {
        return $this->hasMany(Record::class);
    }
}
