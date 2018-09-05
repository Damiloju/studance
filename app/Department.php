<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    public function createNew($data)
    {
        $categories = [];
        foreach ($data as $datum) {
            $datum['created_at'] = Carbon::now();
            $datum['updated_at'] = Carbon::now();
            $datum['slug'] = str_slug($datum['name']);

            if (! $this->where('name', $datum['name'])->exists()) $categories[] = $datum;
        }
        return $this->insert($categories);
    }

    public function college()
    {
        return $this->belongsTo(College::class);
    }
}
