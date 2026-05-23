<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable =[
        'users_id',
        'num_adults',
        'num_kids',
        'exstra_opties_id',
        'time_start',
        'time_end',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function exstra_opties()
    {
        return $this->belongsTo(Exstra_opties::class, 'exstra_opties_id');
    }

    public function boekingen()
    {
        return $this->hasMany(Booking::class);
    }
}
