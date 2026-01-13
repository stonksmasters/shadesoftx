<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body style="margin:0;">
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
</body>
</html>