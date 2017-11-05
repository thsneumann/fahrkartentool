<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class Ticket extends Model
{
    protected $casts = [
        'date' => 'date'
    ];

    public function pointOfDeparture()
    {
        return $this->belongsTo(Location::class, 'point_of_departure_id');
    }

    public function destination()
    {
        return $this->belongsTo(Location::class, 'destination_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
