<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;
use App\Category;

class Ticket extends Model
{
    protected $casts = [
        'date' => 'date'
    ];

    public function locations()
    {
        return $this->belongsToMany(Location::class)->withPivot('index');
    }

    public function origin()
    {
        return $this->locations()->where('index', 0)->first();
    }

    public function destination()
    {
        if ($this->locations()->count() < 2) return null;
        
        return $this->locations()->orderBy('index')->get()->last();
    }

    public function stopovers()
    {
        if ($this->locations()->count() < 3) return null;

        $stopovers = $this->locations()->orderBy('index')->get();
        // remove origin and destination
        $stopovers->shift();
        $stopovers->pop();
        return $stopovers;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vehicleClass()
    {
        return $this->belongsTo(VehicleClass::class);
    }
}
