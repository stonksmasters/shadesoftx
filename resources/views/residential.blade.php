<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residential Solutions | Austin, TX | Shades of Texas</title>
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
                <h1>Residential Home Solutions</h1>
                <p>From energy-saving film to premium Pella® windows, select a category to begin.</p>
            </header>

            <div class="category-block">
                <h2 class="category-title">Tint & Film</h2>
                <div class="services-grid">
                    <a href="{{ url('home-window-tint') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Home Window Tint</h3></div>
                    </a>
                    <a href="{{ url('safety-film') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Safety & Security Film</h3></div>
                    </a>
                    <a href="{{ url('smart-tint') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>SmartTint</h3></div>
                    </a>
                </div>
            </div>

            <div class="category-block">
                <h2 class="category-title">Window Treatments</h2>
                <div class="services-grid">
                    <a href="{{ url('/shades') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Window Shades</h3></div>
                    </a>
                    <a href="{{ url('/shutters') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Window Shutters</h3></div>
                    </a>
                    <a href="{{ url('/blinds') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Window Blinds</h3></div>
                    </a>
                    <a href="{{ url('/storm-shutters') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Safety / Storm Shutters</h3></div>
                    </a>
                </div>
            </div>

            <div class="category-block">
                <h2 class="category-title">Outdoor Living</h2>
                <div class="services-grid">
                    <a href="{{ url('/shade-structures') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Shade Structures</h3></div>
                    </a>
                    <a href="{{ url('/awnings') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Patio Awnings</h3></div>
                    </a>
                    <a href="{{ url('/screens') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Patio Screens</h3></div>
                    </a>
                </div>
            </div>

            <div class="category-block">
                <h2 class="category-title">Glass & Windows</h2>
                <div class="services-grid">
                    <a href="{{ url('/pella-windows') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Pella® Windows</h3></div>
                    </a>
                    <a href="{{ url('/pella-doors') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Pella® Doors</h3></div>
                    </a>
                    <a href="{{ url('/frameless-showers') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Frameless Showers</h3></div>
                    </a>
                    <a href="{{ url('/window-cleaning') }}" class="service-card">
                        <div class="card-image" style="background-image: url('{{ asset('images/awning.jpg') }}');"></div>
                        <div class="card-content"><h3>Window Cleaning</h3></div>
                    </a>
                </div>
            </div>

        </div>
    </main>
    <footer class="main-footer">
    <div class="container">
        <div class="footer-grid">
            
            <div class="footer-brand">
                <a href="{{ url('/') }}" class="logo">SHADES<span>OF</span>TEXAS</a>
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