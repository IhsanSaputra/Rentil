<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\cars;
use App\Models\Category;
use App\Models\categoryes;

class carController extends Controller {
    public function infoCar($id) {
        $cars = Car::find($id);
        $categoryes = Category::all();
        
        return view("car", ["cars" => $cars, "categoryes" => $categoryes]);
    }
}
