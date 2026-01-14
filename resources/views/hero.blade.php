<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Component Mockup</title>
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
    
</head>
<body>

    <section class="hero-split">
        
        <div class="hero-lane residential">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <span class="badge">For Your Home</span>
                <h1>Residential</h1>
                <p>Residential solutions for home owners.</p>
                <div class="hero-actions">
                    <a href="{{ url('/residential') }}"target="_parent" class="hero-btn primary">Home Tinting Solutions</a>
                </div>
            </div>
        </div>

        <div class="hero-lane commercial">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <span class="badge">For Your Business</span>
                <h1>Commercial</h1>
                <p>Professional solutions for offices, retail, and commercial properties.</p>
                <div class="hero-actions">
                    <a href="{{ url('/commercial') }}" target="_parent" class="hero-btn outline">Commercial Solutions</a>
                </div>
            </div>
        </div>

    </section>

</body>
</html>