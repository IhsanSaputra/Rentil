<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Car extends Model
{
    use HasFactory;

    // jika ada relasi ke order, bisa tambahkan:
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    // app/Models/Car.php
    protected $fillable = [
    'name', 'category', 'photo', 'price', 'car_year',
    'car_gearbox', 'car_engine', 'car_engine_capacity',
    'car_doors', 'car_seats', 'description'
    ];
    public $timestamps = false; // Nonaktifkan timestamps

}

