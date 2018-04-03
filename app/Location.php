<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;

class Location extends Model
{
    public function tickets()
    {
        return $this->belongsToMany(Ticket::class)->withPivot('index');
    }

    public function originFor()
    {
        return $this->belongsToMany(Ticket::class)->wherePivot('index', 0);
    }

    public function destinationFor()
    {
        return $this->belongsToMany(Ticket::class)->wherePivot('index', 9999);
    }
}
