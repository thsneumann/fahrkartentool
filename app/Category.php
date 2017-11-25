<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
