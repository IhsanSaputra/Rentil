@extends('adminlte::page')

@section('title', 'Edit Pesanan')

@section('content_header')
    <h1>Edit Pesanan</h1>
@endsection

@section('content')
        <form action="{{ route('edit_order', $order->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="name">Nama Penyewa</label>
            <input type="text" name="name" class="form-control" value="{{ $order->name }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="text" name="phone" class="form-control" value="{{ $order->phone }}" required>
        </div>

        <div class="form-group">
            <label for="age">Umur</label>
            <input type="number" name="age" class="form-control" value="{{ $order->age }}" required>
        </div>

        <div class="form-group">
            <label for="start_datetime">Tanggal Mulai</label>
            <input type="datetime-local" name="start_datetime" class="form-control" 
                value="{{ \Carbon\Carbon::parse($order->start_datetime)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="form-group">
            <label for="end_datetime">Tanggal Selesai</label>
            <input type="datetime-local" name="end_datetime" class="form-control"
                value="{{ \Carbon\Carbon::parse($order->end_datetime)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="form-group">
            <label for="car_id">Mobil</label>
            <select name="car_id" id="car_id" class="form-control" required>
                <option value="" disabled selected>-- Pilih Mobil --</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}" {{ $car->id == $order->car_id ? 'selected' : '' }}>
                        {{ $car->name }} - Rp {{ number_format($car->price) }}/hari
                    </option>
                @endforeach
            </select>
        </div>



        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
@endsection
