@extends('adminlte::page')

@section('title', 'Edit Mobil')

@section('content_header')
    <h1>Edit Mobil</h1>
@endsection

@section('content')
    <form action="{{ route('edit_product', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nama Mobil</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" name="category" value="{{ $product->category }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="photo">Foto (kosongkan jika tidak diganti)</label><br>
            @if ($product->photo)
                <img src="{{ asset('uploads/' . $product->photo) }}" alt="Foto Mobil" width="150" class="mb-2">
            @endif
            <input type="file" name="photo" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="price">Harga Sewa (per jam)</label>
            <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_year">Tahun Mobil</label>
            <input type="number" name="car_year" value="{{ $product->car_year }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_gearbox">Transmisi</label>
            <input type="text" name="car_gearbox" value="{{ $product->car_gearbox }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_engine">Jenis Mesin</label>
            <input type="text" name="car_engine" value="{{ $product->car_engine }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_engine_capacity">Kapasitas Mesin (CC)</label>
            <input type="number" name="car_engine_capacity" value="{{ $product->car_engine_capacity }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_doors">Jumlah Pintu</label>
            <input type="number" name="car_doors" value="{{ $product->car_doors }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="car_seats">Jumlah Kursi</label>
            <input type="number" name="car_seats" value="{{ $product->car_seats }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
@endsection
