<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'class', 
        'participant_count', 
        'start_date', 
        'end_date',
        'status',
    ];

    // public function pengajuan()
    // {
    //     return $this->hasOne(Pengajuan::class, 'booking_id');
    // }
}

