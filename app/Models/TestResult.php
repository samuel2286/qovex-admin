<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id','summary','details','added_by','file'
    ];

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
