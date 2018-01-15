<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    public function createNew($data)
    {
        $programs = [];
        foreach ($data as $datum) {
            $datum['created_at'] = Carbon::now();
            $datum['updated_at'] = Carbon::now();
            $datum['slug'] = str_slug($datum['name']);

            if (! $this->where('name', $datum['name'])->exists()) $programs[] = $datum;
        }
        return $this->insert($programs);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
