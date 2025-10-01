<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\cars;
use App\Models\Category;
use App\Models\categoryes;

class categoryController extends Controller {
    public function categoryCars($category) {
        $cars = Car::where('category', $category)->paginate(20);
        $categoryes = Category::all();
    
        return view("category_car", ["cars" => $cars, "categoryes" => $categoryes, "category" => $category]);
    }
}
