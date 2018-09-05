<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class College extends Model
{
    use SoftDeletes;

    public function createNew($data)
    {
        $colleges = [];
        foreach ($data as $datum) {
            $datum['created_at'] = Carbon::now();
            $datum['updated_at'] = Carbon::now();

            if (! $this->where('shortname', $datum['shortname'])->exists()) $colleges[] = $datum;
        }
        return $this->insert($colleges);
    }
}
