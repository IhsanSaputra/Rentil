<!-- Секциия футера сайта -->
@section("footer")
<footer id="footer">    
    <h1>Rentil</h1>

    <div class="block">
        <h2>More info</h2>

        <a href="{{ route('main') }}" class="first-a">All cars</a>
        <a href="{{ route('about_us') }}">About us</a>
        <a href="{{ route('rental_rules') }}">Rent Rules</a>
    </div>

    <div class="block">
        <h2>Head Office</h2>

        <p>Ponorogo, Indonesia</p>
        <p>Mon-Sun: 24/7</p>
        <p>
            <a href="https://wa.me/6283142183041" style="text-decoration: none; color: inherit;">
                +62 831-4218-3041
            </a>
        </p>
    </div>
</footer>