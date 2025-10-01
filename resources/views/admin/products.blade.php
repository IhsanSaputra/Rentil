@extends('adminlte::page')

@section('title', 'Daftar Mobil')

@section('content_header')
    <h1>Daftar Mobil</h1>
    <a href="{{ route('add_product_form') }}" class="btn btn-primary">+ Tambah Mobil</a>
@endsection

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Mobil</th>
                <th>Kategori</th>
                <th>Foto</th>
                <th>Harga</th>
                <th>Tahun</th>
                <th>Transmisi</th>
                <th>Bahan Bakar</th>
                <th>Kapasitas Mesin</th>
                <th>Jumlah Pintu</th>
                <th>Jumlah Kursi</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->category }}</td>
                    <td>
                        <img src="{{ asset('cover_images/' . $car->photo) }}" alt="{{ $car->name }}" width="80">
                    </td>
                    <td>Rp {{ number_format($car->price) }}</td>
                    <td>{{ $car->car_year }}</td>
                    <td>{{ $car->car_gearbox }}</td>
                    <td>{{ $car->car_engine }}</td>
                    <td>{{ $car->car_engine_capacity }} cc</td>
                    <td>{{ $car->car_doors }}</td>
                    <td>{{ $car->car_seats }}</td>
                    <td>{{ $car->description }}</td>
                    <td>
                        <a href="{{ route('edit_product_form', $car->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('delete_product', $car->id) }}" class="btn btn-sm btn-danger"
                            onclick="return confirm('Hapus mobil ini?')">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
