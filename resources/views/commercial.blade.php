<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commercial Solutions | Austin, TX | Shades of Texas</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
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

    <main class="services-page">
        <div class="container">
            <header class="page-intro">
                <h1>Commercial Window & Patio Solutions</h1>
                <p>Improve energy efficiency, tenant comfort, and facility security with professional-grade installations.</p>
            </header>

            <div class="category-block">
                <h2 class="category-title">Solar Control & Safety</h2>
                <div class="services-grid">
                    <a href="{{ url('commercial-sun-control') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/commercialawning.jpg') }}');"></div>
                        <div class="card-content"><h3>Sun Control Film</h3></div>
                    </a>
                    <a href="{{ url('commercial-security-film') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/commercialawning.jpg') }}');"></div>
                        <div class="card-content"><h3>Safety & Security Film</h3></div>
                    </a>
                    <a href="{{ url('commercial-smart-tint') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/commercialawning.jpg') }}');"></div>
                        <div class="card-content"><h3>SmartTint</h3></div>
                    </a>
                </div>
            </div>

            <div class="category-block">
                <h2 class="category-title">Patio Screens & Awnings</h2>
                <div class="services-grid">
                    <a href="{{ url('commercial-awnings') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/commercialawning.jpg') }}');"></div>
                        <div class="card-content"><h3>Patio Awnings</h3></div>
                    </a>
                    <a href="{{ url('commercial-screens') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/commercialawning.jpg') }}');"></div>
                        <div class="card-content"><h3>Patio Screens</h3></div>
                    </a>
                </div>
            </div>

            <div class="category-block">
                <h2 class="category-title">Glass & Windows</h2>
                <div class="services-grid">
                    <a href="{{ url('commercial-glazing') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/commercialawning.jpg') }}');"></div>
                        <div class="card-content"><h3>Commercial Glazing</h3></div>
                    </a>
                </div>
            </div>

            <div class="category-block">
                <h2 class="category-title">Window Treatments</h2>
                <div class="services-grid">
                    <a href="{{ url('commercial-roller-shades') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/commercialawning.jpg') }}');"></div>
                        <div class="card-content"><h3>Roller Shades</h3></div>
                    </a>
                </div>
            </div>

        </div>
    </main>
    <footer class="main-footer">
    <div class="container">
        <div class="footer-grid">
            
            <div class="footer-brand">
                <a href="{{ url('/') }}" class="logo" aria-label="Shades of Texas - Home">SHADES<span>OF</span>TEXAS</a>
                <p>Austin’s premier destination for high-performance solar protection and architectural glass solutions since 1989.</p>
            </div>

            <nav class="footer-col" aria-label="Solutions">
                <h4>Solutions</h4>
                <a href="{{ url('/residential') }}">Residential Tint</a>
                <a href="{{ url('/commercial') }}">Commercial Film</a>
                <a href="{{ url('/pella') }}">Pella® Windows</a>
            </nav>

            <nav class="footer-col" aria-label="Company information">
                <h4>Company</h4>
                <a href="{{ url('/about') }}">Our Story</a>
                <a href="{{ url('/gallery') }}">Project Gallery</a>
                <a href="{{ url('/contact') }}">Contact Us</a>
            </nav>

            <nav class="footer-col" aria-label="Contact information">
                <h4>Contact</h4>
                <a href="tel:5125550199" aria-label="Call us at 512-555-0199">(512) 555-0199</a>
                <a href="mailto:hello@shadesoftx.com">Email Us</a>
                <a href="{{ url('/booking') }}">Book Estimate</a>
            </nav>

        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 Shades of Texas. All Rights Reserved.</p>
            <p>Built for Austin Excellence</p>
        </div>
    </div>
</footer>
</body>
</html>