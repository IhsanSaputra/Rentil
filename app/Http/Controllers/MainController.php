<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Car;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function allCars()
    {
         $cars = Car::all(); 
        $categories = Category::all();

        return view("main", [
            "cars" => $cars,
            "categories" => $categories
        ]);
    }

    public function rentRules()
    {
        $categories = Category::all();

        return view("rental_rules", [
            "categories" => $categories
        ]);
    }

    public function aboutUs()
    {
        $categories = Category::all();

        return view("about_us", [
            "categories" => $categories
        ]);
    }
}
