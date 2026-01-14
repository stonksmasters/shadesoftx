<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patio Screens | Austin, TX | Shades of Texas</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service-detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alerts.css') }}">
</head>
<body>
    <header class="site-header">
        <nav class="main-nav">
            <div class="container nav-flex">
                <a href="{{ url('/') }}" class="brand-logo">
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

    <section class="service-hero">
        <div class="container hero-flex">
            <div class="hero-text">
                <span class="badge" style="background: #111;">Commercial Excellence</span>
                <h1>Patio Screens</h1>
                <p class="lead">Motorized retractable screens that create bug-free outdoor dining and event spaces for Austin businesses.</p>
                <div class="cta-row">
                    <a href="{{ url('/booking?service=commercial-screens') }}" class="btn btn-main">Book Free Estimate</a>
                    <a href="#details" class="btn btn-secondary">View Details</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/commercialawning.jpg') }}" alt="Commercial retractable patio screens">
            </div>
        </div>
    </section>

    <section id="details" class="details-section">
        <div class="container details-grid">
            <div class="details-content">
                <h2>Why Choose Patio Screens?</h2>
                <p>Commercial patio screens allow restaurants and hospitality venues to maximize outdoor seating while keeping pests out. Motorized retractable screens deploy quickly when needed and disappear when Austin weather is perfect.</p>
                <p>Our heavy-duty screens withstand commercial use while blocking insects, wind, and light rain. Solar mesh options reduce heat and glare while maintaining views. Remote control operation makes it easy to adjust screens throughout the day.</p>
                <p>Shades of Texas designs screen systems to span large openings while meeting ADA requirements and building codes. We handle electrical installation, control integration, and staff training for seamless operation.</p>
            </div>
            <div class="specs-box">
                <h4>Technical Details</h4>
                <ul class="specs-list">
                    <li><strong>Types:</strong> Motorized Retractable, Fixed Frame</li>
                    <li><strong>Mesh Options:</strong> Insect, Solar, Privacy</li>
                    <li><strong>Max Width:</strong> Up to 30 feet per panel</li>
                    <li><strong>Warranty:</strong> 5-Year Commercial</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-wrapper">
                
                <div class="contact-visual">
                    <h2>Contact <span>Project Desk</span></h2>
                    
                    <div class="direct-contact">
                        <div class="item">
                            <label>Central Texas Office</label>
                            <p>Jarrell, TX 76537</p>
                        </div>
                        <div class="item">
                            <label>Estimates & Sales</label>
                            <p>(512) 555-0199</p>
                        </div>
                    </div>
                </div>

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

                <form class="contact-form-panel" action="/contact" method="POST">
                    @csrf
                    <div class="form-header">
                        <h3>Step 01</h3>
                        <p>Tell us about your architectural glass or solar needs.</p>
                    </div>

                    <div class="input-group">
                        <input type="text" name="name" placeholder=" " required>
                        <label>Full Name</label>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                        <div class="input-group">
                            <input type="email" name="email" placeholder=" " required>
                            <label>Email Address</label>
                        </div>
                        <div class="input-group">
                            <input type="tel" name="phone" placeholder=" " required>
                            <label>Phone</label>
                        </div>
                    </div>

                    <div class="input-group">
                        <textarea name="message" rows="4" placeholder=" " required></textarea>
                        <label>Message / Project Scope</label>
                    </div>

                    <button type="submit" class="cta-button">Initiate Request</button>
                </form>

            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="logo">SHADES<span>OF</span>TEXAS</a>
                    <p>Austin's premier destination for high-performance solar protection and architectural glass solutions since 1989.</p>
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
