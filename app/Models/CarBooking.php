<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBooking extends Model
{
  use HasFactory;

  protected $fillable = [
    'car_id',
    'user_id',
    'pickup_location',
    'dropoff_location',
    'pick_up_date',
    'drop_off_date',
    'rate',
    'discount_rate',
    'status',
    'date',
    'rent_type',
    'total_km',
    'pickup_location',
    'car_rate',
    'total_fare',
  ];

  // Relationships, if any
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function car()
  {
    return $this->belongsTo(Car::class);
  }
}
