<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Car;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;


class adminController extends Controller
{
    public function loginAdmin() {
        return view('admin.login');
    }

    public function loginAdminForm(Request $request) 
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === 'admin' && $password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin_dashboard');
        } else {
            return redirect()->back()->with('error', 'Login gagal');
        }
    }

    public function products() {
        // Ambil semua data dari tabel cars
        $cars = Car::all();
        return view('admin.products', compact('cars'));
    }

    public function ordersAdmin() {
        $orders = Order::with('car')->get();
        return view('admin.orders', compact('orders'));
    }

    public function orderInfo($id) {
        $order = DB::table('orders')->where('id', $id)->first();
        return view('admin.order_info', compact('order'));
    }

    public function showAddProduct() {
        return view('admin.add_product');
    }

    
    public function addProduct(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric',
            'car_year' => 'required|numeric',
            'car_gearbox' => 'required|string',
            'car_engine' => 'required|string',
            'car_engine_capacity' => 'required|numeric',
            'car_doors' => 'required|numeric',
            'car_seats' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Upload foto mobil
        $photoName = Str::random(10) . '.' . $request->photo->extension();
        $request->photo->move(public_path('cover_images/'), $photoName);

        // Simpan ke database
        Car::create([
            'name' => $request->name,
            'category' => $request->category,
            'photo' => $photoName,
            'price' => $request->price,
            'car_year' => $request->car_year,
            'car_gearbox' => $request->car_gearbox,
            'car_engine' => $request->car_engine,
            'car_engine_capacity' => $request->car_engine_capacity,
            'car_doors' => $request->car_doors,
            'car_seats' => $request->car_seats,
            'description' => $request->description,
        ]);

        return redirect()->route('products')->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function showEditProduct($id) {
        $product = DB::table('cars')->where('id', $id)->first();
        return view('admin.edit_product', compact('product'));
    }

    public function editProduct(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'car_year' => $request->car_year,
            'car_gearbox' => $request->car_gearbox,
            'car_engine' => $request->car_engine,
            'car_engine_capacity' => $request->car_engine_capacity,
            'car_doors' => $request->car_doors,
            'car_seats' => $request->car_seats,
            'description' => $request->description,
        ];

        // Jika ada upload file foto baru
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('cover_images/'), $filename);

            $data['photo'] = $filename;
        }

        // Simpan update ke database
        DB::table('cars')->where('id', $id)->update($data);

        return redirect('/products')->with('success', 'Data mobil berhasil diperbarui');
    }


    public function deleteProduct($id) {
        DB::table('cars')->where('id', $id)->delete();
        return redirect('/products')->with('success', 'Mobil berhasil dihapus');
    }
    
    // Tampilkan form edit pesanan
    public function showEditOrderForm($id)
    {
        $order = Order::findOrFail($id);
        $cars = Car::all(); // Ambil semua mobil untuk dropdown
        return view('admin.edit_order', compact('order', 'cars'));
    }

    // Proses update pesanan
    public function editOrder(Request $request, $id)
    {
        // Validasi input (car_id adalah foreign key)
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'age' => 'required|numeric',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after_or_equal:start_datetime',
            'car_id' => 'required|exists:cars,id',
        ]);

        // Ambil data mobil berdasarkan ID
        $car = Car::findOrFail($request->car_id);

        // Hitung durasi sewa dalam hari (minimal 1 hari)
        $start = Carbon::parse($request->start_datetime);
        $end = Carbon::parse($request->end_datetime);
        $days = max(1, $start->diffInDays($end));

        // Hitung total harga
        $totalPrice = $car->price * $days;

        // Update pesanan di database
        Order::where('id', $id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'age' => $request->age,
            'start_datetime' => $start,
            'end_datetime' => $end,
            'car_id' => $car->id, // Simpan sebagai ID mobil
            'car' => $car ? $car->name : '-', // <-- ini tambahan
            'price_day' => $totalPrice,
        ]);

        return redirect()->route('orders')->with('success', 'Pesanan berhasil diperbarui');
    }

    // Hapus pesanan
    public function deleteOrder($id)
    {
        Order::destroy($id);
        return redirect()->route('orders')->with('success', 'Pesanan berhasil dihapus');
    }

    public function usersAdmin() {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Hindari menghapus admin utama (optional)
        if ($user->is_admin ?? false) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun admin.');
        }

        $user->delete();

        return redirect()->route('admin_users')->with('success', 'Akun berhasil dihapus.');
    }

    
    public function dashboard()
    {
        $users = \App\Models\User::count();
        $orders = Order::all();

        // Hitung total pendapatan dari price_day * durasi
        $totalIncome = 0;
        foreach ($orders as $order) {
            if ($order->start_datetime && $order->end_datetime && $order->price_day) {
                $start = Carbon::parse($order->start_datetime);
                $end = Carbon::parse($order->end_datetime);
                $days = $start->diffInDays($end);
                $days = $days === 0 ? 1 : $days;
                $totalIncome += $order->price_day * $days;
            }
        }

        return view('admin.dashboard', [
            'totalUsers' => $users,
            'totalOrders' => $orders->count(),
            'totalIncome' => $totalIncome,
            'latestOrders' => $orders->sortByDesc('created_at')->take(5)
        ]);
        }


}
