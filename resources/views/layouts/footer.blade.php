<footer class="footer">
    <div class="footer-container">
        <div class="footer-about">
            <h3>Beacon Villa</h3>
            <p>Relax. Book. Enjoy your stay with comfort and ease.</p>
        </div>

        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/#rooms') }}">Rooms</a></li>
                <li><a href="{{ url('/my-bookings') }}">My Bookings</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
        </div>

        <div class="footer-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Beacon Villa. All rights reserved.</p>
    </div>
</footer>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">