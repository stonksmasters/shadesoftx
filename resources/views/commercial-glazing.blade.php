<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commercial Glazing & Glass Services | Austin, TX</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service-detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alerts.css') }}">

</head>
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
                    <li><a href="re">Reviews</a></li>
                    <li class="cta-container">
                        <a href="#quote" class="btn-primary">Get Free Estimate</a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>
<body>
    <section class="service-hero">
        <div class="container hero-flex">
            <div class="hero-text">
                <span class="badge" style="background: #111;">Commercial Excellence</span>
                <h1>Commercial <br>Glazing Services</h1>
                <p class="lead">From storefront replacements to large-scale glass installations, we provide Austin businesses with structural integrity and modern aesthetics.</p>
                <div class="cta-row">
                    <a href="http://127.0.0.1:8000/booking?service=commercial-glazing" class="btn btn-main">Request Commercial Bid</a>
                    <a href="#details" class="btn btn-secondary">Service Details</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/commercialglazing.jpg') }}" alt="Modern office building glass installation">
            </div>
        </div>
    </section>

    <section id="details" class="details-section">
        <div class="container details-grid">
            <div class="details-content">
                <h2>Precision Glazing for Austin Business</h2>
                <p>Shades of Texas offers full-service commercial glazing. Whether you are dealing with a shattered storefront that needs emergency replacement or a new construction project requiring specialized architectural glass, our team is equipped to handle the job with safety and speed.</p>
                <p><strong>SEO Keywords:</strong> Commercial glazing Austin, storefront glass repair, architectural glass Texas, business window replacement.</p>
            </div>
            <div class="specs-box">
                <h4>Service Capabilities</h4>
                <ul class="specs-list">
                    <li><strong>Glass Types:</strong> Tempered, Laminated, Insulated</li>
                    <li><strong>Systems:</strong> Center-glazed, Front-glazed</li>
                    <li><strong>Compliance:</strong> Meets all TX Building Codes</li>
                    <li><strong>Support:</strong> 24/7 Emergency Repair available</li>
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