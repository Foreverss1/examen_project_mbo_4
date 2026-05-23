<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Booking extends Model
{
    use HasFactory;
      protected $table = 'bookings';

   protected $fillable =[
        'reservations_id',
        'baan_id',
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservations_id');
    }

    public function banen()
    {
        return $this->belongsTo(Baan::class,  'baan_id' );
    }
}
