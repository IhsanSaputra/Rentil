@extends('adminlte::page')

@section('title', 'Tambah Mobil')

@section('content_header')
    <h1>Tambah Mobil</h1>
@endsection

@section('content')
    <form action="{{ route('add_product') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nama Mobil</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" name="category" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="photo">Foto Mobil</label>
            <input type="file" name="photo" class="form-control-file" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="price">Harga Sewa per Hari (Rp)</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_year">Tahun Mobil</label>
            <input type="number" name="car_year" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_gearbox">Transmisi</label>
            <select name="car_gearbox" class="form-control" required>
                <option value="Manual">Manual</option>
                <option value="Otomatis">Otomatis</option>
            </select>
        </div>

        <div class="form-group">
            <label for="car_engine">Tipe Mesin</label>
            <input type="text" name="car_engine" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_engine_capacity">Kapasitas Mesin (CC)</label>
            <input type="number" name="car_engine_capacity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_doors">Jumlah Pintu</label>
            <input type="number" name="car_doors" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_seats">Jumlah Kursi</label>
            <input type="number" name="car_seats" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Mobil</button>
    </form>
@endsection
