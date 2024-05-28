<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Car extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $fillable = [
    'category_id',
    'owner_id',
    'brand_id',
    'name',
    'brand_name',
    'reg_no',
    'color',
    'model',
    'owner_name',
    'owner_contact_no',
    'owner_email',
    'description',
    'full_day_rate_with_fuel',
    'full_day_rate_without_fuel',
    'full_day_rate_with_driver',
    'full_day_rate_without_driver',
    'per_km_rate_with_fuel',
    'per_km_rate_without_fuel',
    'longitude',
    'latitude',
    'sale_price',
    'discounted_sale_price',
  ];

  public function category()
  {
    return $this->belongsTo(CarCategory::class, 'category_id');
  }
}
