<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'jurusan', 
        'participant_count', 
        'start_date', 
        'end_date',
        'status',
        'user_id',
        'color',
        'document'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function pengajuan()
    // {
    //     return $this->hasOne(Pengajuan::class, 'booking_id');
    // }
}
