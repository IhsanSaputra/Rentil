@extends("layouts.app")

{{-- Judul halaman --}}
@section("title")
    Car Rent | Checkout
@endsection

{{-- Bagian Checkout --}}
@section("checkout")
    {{-- Navigasi --}}
    <div class="web-nav">
        <span>Main > {{ $car->name }} > Checkout</span>
    </div>

    {{-- Formulir Pemesanan --}}
    <div class="checkout">
        <form action="{{ route('checkoutForm', $car->id) }}" method="post">
            @csrf
            <h2>Booking Form</h2>

            <input type="hidden" name="car" value="{{ $car->name }}"><br>
            <input type="hidden" name="price" value="{{ $car->price }}"><br>

            <label for="name">Full Name</label><br>
            <input type="text" id="name" placeholder="Full name" name="name" required><br>

            <label for="phone">Phone Number</label><br>
            <input type="text" id="phone" placeholder="Phone number" name="phone" required><br>

            <label for="age">Age</label><br>
            <input type="number" id="age" placeholder="Age" name="age" required><br>

            <label for="start_datetime">Start Date & Time</label><br>
            <input type="datetime-local" id="start_datetime" name="start_datetime" 
                value="{{ old('start_datetime') }}" required><br>

            <label for="end_datetime">End Date</label><br>
            <input type="datetime-local" id="end_datetime" name="end_datetime" 
                value="{{ old('end_datetime') }}" required><br>

            {{-- Pesan sukses --}}
            @if (session("success"))
                <div class="alert-success">
                    <span>{{ session('success') }}</span><br>
                </div>
            @endif

            {{-- Pesan error --}}
            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $el)
                            <li>{{ $el }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit">Booking</button>
        </form>

        <div class="container">
            <h1>{{ $car->name }}</h1>
            <img src="{{ asset('cover_images/' . $car->photo) }}" alt="{{ $car->name }}">
        </div>
    </div>
@endsection
