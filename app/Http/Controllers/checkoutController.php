<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\checkoutRequest;
use App\Models\Car;
use App\Models\Category;
use App\Models\Order;
use Carbon\Carbon;

class checkoutController extends Controller
{
    public function checkout($id)
    {
        $car = Car::findOrFail($id);
        $categoryes = Category::all();

        return view("checkout", [
            "car" => $car,
            "categoryes" => $categoryes
        ]);
    }

    public function checkoutForm($id, checkoutRequest $req)
    {
        $car = Car::findOrFail($id);
        $categoryes = Category::all();

        // Ambil langsung start & end dari form (datetime)
        $start = Carbon::parse($req->input("start_datetime"));
        $end   = Carbon::parse($req->input("end_datetime"));

        // Pastikan end > start
        if ($end->lessThanOrEqualTo($start)) {
            return back()->withErrors(['end_datetime' => 'End time must be after start time.'])->withInput();
        }

        // Hitung durasi minimal 1 hari
        $durationDays = max($start->diffInDays($end), 1);

        // Hitung total harga
        $totalPrice = $car->price * $durationDays;

        // Simpan ke database
        $orders = new Order();
        $orders->name = $req->input("name");
        $orders->phone = $req->input("phone");
        $orders->age = $req->input("age");
        $orders->start_datetime = $start;
        $orders->end_datetime = $end;
        $orders->car = $car->name;
        $orders->price_day = $totalPrice;
        $orders->save();

        Session::flash("success", "Reservation submitted for $durationDays day(s). Total: Rp " . number_format($totalPrice, 0, ',', '.'));

        return view("checkout", [
            "categoryes" => $categoryes,
            "car" => $car
        ])->with("success", "Reservation successful!");
    }
}
