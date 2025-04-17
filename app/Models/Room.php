<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hostel_id',
        'room_number',
        'type',
        'capacity',
        'price',
        'status',
        'description',
        'amenities',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'capacity' => 'integer',
        'amenities' => 'array',
    ];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function currentBooking()
    {
        return $this->hasOne(Booking::class)->where('status', 'active')->latest();
    }
}