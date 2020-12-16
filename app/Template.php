<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $guarded = [
        'id'
    ];

    public function items()
    {
        return $this->belongsToMany('App\Item')
            ->withPivot('sorting')
            ->orderBy('sorting');
    }
}
