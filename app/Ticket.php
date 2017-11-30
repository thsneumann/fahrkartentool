<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;
use App\Category;

class Ticket extends Model
{
    public function pointOfDeparture()
    {
        return $this->belongsTo(Location::class, 'point_of_departure_id');
    }

    public function destination()
    {
        return $this->belongsTo(Location::class, 'destination_id');
    }

/*     public function tags()
    {
        return $this->belongsToMany(Tag::class);
    } */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vehicleClass()
    {
        return $this->belongsTo(VehicleClass::class);
    }
}
