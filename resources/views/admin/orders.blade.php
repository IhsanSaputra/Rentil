@extends('adminlte::page')

@section('title', 'Daftar Pesanan')

@section('content_header')
    <h1>Daftar Pesanan</h1>
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Penyewa</th>
                <th>Telepon</th>
                <th>Umur</th>
                <th>Mulai Sewa</th>
                <th>Selesai Sewa</th>
                <th>Mobil</th>
                <th>Total Harga (Per Hari)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->age }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->start_datetime)->format('d-m-Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->end_datetime)->format('d-m-Y H:i') }}</td>
                    <td>{{ $order->car }}</td>
                    <td>Rp {{ number_format($order->price_day) }}</td>
                    <td>
                        <a href="{{ route('edit_order_form', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('delete_order', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
