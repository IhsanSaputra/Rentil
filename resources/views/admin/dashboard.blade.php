@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <h1>Dashboard Admin</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Pengguna</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalOrders }}</h3>
                <p>Total Pesanan</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Rp {{ number_format(max($totalIncome, 0), 0, ',', '.') }}</h3>
                <p>Total Pendapatan</p>
            </div>
            <div class="icon">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>
</div>

{{-- Tabel pesanan terbaru --}}
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Pesanan Terbaru</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Mobil</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestOrders as $order)
                    @php
                        $start = $order->start_datetime ? \Carbon\Carbon::parse($order->start_datetime) : null;
                        $end = $order->end_datetime ? \Carbon\Carbon::parse($order->end_datetime) : null;

                        $days = ($start && $end) ? $start->diffInDays($end) : 0;
                        $days = $days === 0 ? 1 : $days;

                        $priceDay = $order->price_day ?? 0;
                        $total = $priceDay * $days;
                    @endphp
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ optional($order->car)->name ?? '-' }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data pesanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
