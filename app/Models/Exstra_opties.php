<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Exstra_opties extends Model
{
    use HasFactory;

    // remove later
    protected $fillebol =[
        'naam',
        'omschrijving',
        'cost'
    ];
    public function reservations()
    {
        return $this->hasMany(reservation::class);
    }
}
