<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Baan extends Model
{
    use HasFactory;
    protected $table = 'banen';

    public function reservation()
    {
        return $this->hasMany(reservation::class);
    }
}
