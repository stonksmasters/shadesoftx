<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking | Austin, TX</title>
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
     <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
      <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
      <link rel="stylesheet" href="{{ asset('css/alerts.css') }}">
</head>
<body>
      <header class="site-header">
            <nav class="main-nav">
            <div class="container nav-flex">
                
                <a href="{{ url('/'  ) }}" class="brand-logo">
                    SHADES<span class="light-text">OFTEXAS</span>
                    <span class="location-badge">AUSTIN</span>
                </a>

                <input type="checkbox" id="nav-toggle" class="nav-toggle-input">
                <label for="nav-toggle" class="nav-hamburger">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </label>

                <ul class="nav-links">
                    <li><a href="{{ url('/residential') }}">Residential</a></li>
                    <li><a href="{{ url('/commercial') }}">Commercial</a></li>
                    <li><a href="{{ url('/reviews') }}">Reviews</a></li>
                    <li class="cta-container">
                        <a href="#quote" class="btn-primary">Get Free Estimate</a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>
   <section class="booking-section">
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST" class="booking-card" id="appointmentForm">
            @csrf
             <div class="booking-summary">
                <h2>Secure Your Consultation</h2>
                <div class="service-display">
                    <span>Selected Service:</span>
                    <h3 id="service-text">General Inquiry</h3>
                </div>
            </div>

            <div class="booking-form">
                <input type="hidden" name="service_type" id="service-slug" value="general-inquiry">
                <input type="hidden" name="selected_date" id="final-date-input" required>

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="book-input" placeholder="First and Last Name" required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" class="book-input" placeholder="(512) 000-0000" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="book-input" placeholder="example@email.com" required>
                </div>

                <div class="form-group">
                    <label>Select Arrival Date</label>
                    <div class="calendar-nav">
                        <button type="button" class="nav-btn" id="prevMonth">&lt;</button>
                        <span class="month-display" id="monthDisplay"></span>
                        <button type="button" class="nav-btn" id="nextMonth">&gt;</button>
                    </div>
                    
                    <div class="calendar-weekdays">
                        <span>S</span><span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span>
                    </div>
                    <div class="calendar-grid" id="calendarGrid"></div>
                </div>

                <button type="submit" class="btn-submit">Confirm Appointment</button>
            </div>
        </form>
    </div>
</section>
<footer class="main-footer">
    <div class="container">
        <div class="footer-grid">
            
            <div class="footer-brand">
                <a href="{{ url('/'  ) }}" class="logo">SHADES<span>OF</span>TEXAS</a>
                <p>Austin’s premier destination for high-performance solar protection and architectural glass solutions since 1989.</p>
            </div>

            <div class="footer-col">
                <h4>Solutions</h4>
                <a href="{{ url('/residential') }}">Residential Tint</a>
                <a href="{{ url('/commercial') }}">Commercial Film</a>
                <a href="{{ url('/pella') }}">Pella® Windows</a>
            </div>

            <div class="footer-col">
                <h4>Company</h4>
                <a href="{{ url('/about') }}">Our Story</a>
                <a href="{{ url('/gallery') }}">Project Gallery</a>
                <a href="{{ url('/contact') }}">Contact Us</a>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <a href="tel:5125550199">(512) 555-0199</a>
                <a href="mailto:hello@shadesoftx.com">Email Us</a>
                <a href="{{ url('/booking') }}">Book Estimate</a>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 Shades of Texas. All Rights Reserved.</p>
            <p>Built for Austin Excellence</p>
        </div>
    </div>
</footer>
<script src="booking.js"></script>
</body>
</html>