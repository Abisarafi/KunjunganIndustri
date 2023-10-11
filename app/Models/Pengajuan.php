<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'visit_date',
        'company_name',
        'contact_person_name',
        'contact_person_email',
        'purpose',
        'status',
        'class',
        'participant_count'
    ];
}
