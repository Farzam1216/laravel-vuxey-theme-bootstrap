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
    'pick_up_location',
    'drop_off_location',
    'pick_up_date',
    'drop_off_date',
    'rate',
    'discount_rate',
    'status',
    'date',
  ];


  public function car()
  {
    return $this->belongsTo(Car::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
