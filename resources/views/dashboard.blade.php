<head>
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    @include('layouts.navbar')
    <main>
        <!-- Hero Slider -->
        <div class="slide"
            style="background-image: url('{{ asset('images/slidshow-image-1.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="slide-content">
                <h1>Welcome to Beacon Villa</h1>
                <p>Beacon Villa is your perfect escape for comfort, relaxation, and unforgettable memories...</p>
                <button onclick="location.href='{{ route('login') }}';">Log in</button>
                <button onclick="location.href='{{ route('register.user') }}';">Register</button>
            </div>
        </div>

        <div class="slide"
            style="background-image: url('{{ asset('images/slidshow-image-2.jpg') }}');background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="slide-content">
                <h1>Your Home Away from Home</h1>
                <p>At Beacon Villa, we believe every guest deserves more than just a stay...</p>
                <button onclick="location.href='{{ route('rooms.show', 1) }}';">Reservation</button>
            </div>
        </div>

        <div class="slide"
            style="background-image: url('{{ asset('images/slidshow-image-3.jpg') }}');background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="slide-content">
                <h1>Discover the Charm of Beacon Villa</h1>
                <p>Step into a world of comfort and elegance at Beacon Villa...</p>
            </div>
        </div>

        <a class="prev" onclick="plusHeroSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusHeroSlides(1)">&#10095;</a>
    </main>

    <!-- Welcome Section -->
    @if(auth()->check())
    <div class="welcome-bar">
        <div class="welcome-left">
            Welcome, <strong>{{ auth()->user()->name }}</strong>!
        </div>
        <div class="welcome-right">
            {{ auth()->user()->email }}
        </div>
    </div>
    @endif

    <!-- Gallery Section -->
    <section id="gallery">
        <h2>Gallery</h2>
        <div class="gallery-wrapper">
            <button class="gallery-btn prev" onclick="moveGallery(-1)">&#10094;</button>
            <div class="gallery-container">
                <div class="gallery-slide">
                    @for ($i = 1; $i <= 12; $i++)
                        <img src="{{ asset("images/gallery/$i.jpg") }}" alt="Image {{ $i }}">
                    @endfor
                </div>
            </div>
            <button class="gallery-btn next" onclick="moveGallery(1)">&#10095;</button>
        </div>
    </section>

   <!-- Rooms Section -->
<section class="rooms-section" id="rooms">
    <h2>Our Rooms</h2>
    <div class="rooms-container">
        @php
            use Carbon\Carbon;
            $today = Carbon::today()->toDateString();

            // Define room images
            $roomImages = [
                1 => ['images/rooms/1/room-1-1.jpg', 'images/rooms/1/room-1-2.jpg'],
                2 => ['images/rooms/2/room-2-1.jpg', 'images/rooms/2/room-2-2.jpg'],
                3 => ['images/rooms/3/room-3-1.jpg', 'images/rooms/3/room-3-2.jpg'],
                4 => ['images/rooms/4/room-4-1.jpg', 'images/rooms/4/room-4-2.jpg'],
                5 => ['images/rooms/5/room-5-1.jpg', 'images/rooms/5/room-5-2.jpg'],
            ];
        @endphp

        @foreach($rooms as $room)
            @php
                $isBookedToday = $room->bookings->where('booking_date', $today)->where('status', 'active')->count() > 0;
                $images = $roomImages[$room->room_number] ?? ['images/rooms/default.jpg'];
                $price = $room->price ?? 4500; // ✅ Use DB column instead of hardcoded array
            @endphp

            <div class="room-row">
                <!-- Left -->
                <div class="room-left">
                    <h3>Room {{ $room->room_number }}</h3>
                    <p>{{ $room->description ?? 'Comfortable room with all amenities.' }}</p>
                    <div class="room-price">
                        <span>Price: </span>
                        <strong>{{ number_format($price, 2) }} Rs</strong>
                    </div>

                    <div class="booking-buttons">
                        @if($isBookedToday)
                            <button class="btn-booked" disabled>Booked Today</button>
                        @else
                            <a href="{{ route('rooms.show', $room->id) }}">
                                <button class="btn-available">Book Now</button>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right -->
                <div class="room-right">
                    <div class="slideshow-container" id="slideshow-{{ $room->id }}">
                        @foreach($images as $index => $img)
                            <img src="{{ asset($img) }}" class="slide-img room-slide-{{ $room->id }}"
                                style="width:100%; display:{{ $index === 0 ? 'block' : 'none' }};"
                                alt="Room {{ $room->room_number }}">
                        @endforeach

                        @if(count($images) > 1)
                            <a class="prev" onclick="plusSlides({{ $room->id }}, -1)">&#10094;</a>
                            <a class="next" onclick="plusSlides({{ $room->id }}, 1)">&#10095;</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

    <!-- Scripts -->
    <script>
        // HERO SLIDER
        let heroIndex = 0;
        const heroSlides = document.getElementsByClassName("slide");

        function showHeroSlides() {
            for (let i = 0; i < heroSlides.length; i++) heroSlides[i].style.display = "none";
            heroIndex++;
            if (heroIndex > heroSlides.length) heroIndex = 1;
            heroSlides[heroIndex - 1].style.display = "flex";
            setTimeout(showHeroSlides, 4000);
        }
        function plusHeroSlides(n) {
            heroIndex += n - 1;
            if (heroIndex < 0) heroIndex = heroSlides.length - 1;
            showHeroSlides();
        }
        showHeroSlides();

        // ROOM SLIDESHOW
        let slideIndexes = {};
        @foreach($rooms as $room)
            slideIndexes[{{ $room->id }}] = 0;
        @endforeach

        function showSlides(roomId, n) {
            let slides = document.querySelectorAll('.room-slide-' + roomId);
            if (slides.length === 0) return;

            slideIndexes[roomId] += n;
            if (slideIndexes[roomId] >= slides.length) slideIndexes[roomId] = 0;
            if (slideIndexes[roomId] < 0) slideIndexes[roomId] = slides.length - 1;

            slides.forEach(slide => slide.style.display = "none");
            slides[slideIndexes[roomId]].style.display = "block";
        }
        function plusSlides(roomId, n) {
            showSlides(roomId, n);
        }

        // GALLERY SLIDER
        let galleryIndex = 0;
        const gallerySlide = document.querySelector(".gallery-slide");
        const galleryImages = document.querySelectorAll(".gallery-slide img");
        const totalGalleryImages = galleryImages.length;
        let imagesPerView = 6;

        function updateGalleryView() {
            if (window.innerWidth <= 600) imagesPerView = 2;
            else if (window.innerWidth <= 1024) imagesPerView = 3;
            else imagesPerView = 6;
        }
        updateGalleryView();
        window.addEventListener("resize", updateGalleryView);

        function moveGallery(step) {
            galleryIndex += step;
            const maxIndex = totalGalleryImages - imagesPerView;
            if (galleryIndex < 0) galleryIndex = 0;
            if (galleryIndex > maxIndex) galleryIndex = maxIndex;

            const slideWidth = galleryImages[0].clientWidth + 10;
            gallerySlide.style.transform = `translateX(-${galleryIndex * slideWidth}px)`;
        }
    </script>

    @include('layouts.footer')
</body>
