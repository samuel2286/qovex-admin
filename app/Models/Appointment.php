<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','user_id','test_offers','gender','address','appointment_date','status','approved_by'
    ];

    protected $casts = [
        'test_offers' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function approvedBy(){
        return $this->belongsTo(User::class, 'approved_by');
    }
}
