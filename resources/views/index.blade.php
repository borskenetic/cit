<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="{{ $brand['favicon_mime'] ?? 'image/x-icon' }}" href="{{ $brand['favicon_url'] }}">
    <title>{{ $brand['school_name'] }} | Library Portal</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="logo-container">
            <a href="{{ route('home') }}" class="brand-link" aria-label="{{ $brand['school_name'] }} home">
                <img src="{{ $brand['logo_landscape_url'] }}" alt="{{ $brand['school_name'] }} logo" class="brand-logo">
            </a>
        </div>
        <nav class="nav-links" aria-label="Main navigation">
            <ul>
                <li><a href="#about">ABOUT</a></li>
                <li><a href="{{ route('landing') }}">OPAC</a></li>
                <li><a href="{{ $brand['zendy_url'] }}" target="_blank" rel="noopener noreferrer">ZENDY</a></li>
                <li><a href="#contact">CONTACT US</a></li>
                <li><a href="{{ route('rooms.book') }}">ROOM RESERVATIONS</a></li>
                <li><a href="{{ route('feedback.create') }}">FEEDBACK</a></li>
                <li><a href="{{ route('login') }}" class="login-button">LOGIN</a></li>
            </ul>
        </nav>
    </header>

    <main class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="center-logo-wrapper">
                <img src="{{ $brand['logo_url'] }}" alt="{{ $brand['library_name'] }}" class="center-seal">
            </div>

            <div class="search-card">
                <span class="card-subtitle">ONLINE PUBLIC ACCESS CATALOG</span>
                <h1 class="card-title">Search the {{ $brand['library_name'] }} Collection</h1>
                <p class="card-description">Find books by title, author, subject, ISBN, or keyword.</p>

                <form class="search-form" action="{{ route('landing') }}" method="GET">
                    <input type="hidden" name="view" value="books">
                    <div class="input-wrapper">
                        <span class="search-icon" aria-hidden="true">⌕</span>
                        <input type="text" name="search" id="searchInput" placeholder="Search title, author, keyword..." autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn-search">Search OPAC</button>
                </form>
            </div>
        </div>
    </main>

    <section class="feature-strip">
        <div class="feature-card">
            <h2>Access the catalog</h2>
            <p>Browse the collection online before visiting the library.</p>
            <a href="{{ route('landing') }}" class="feature-link">Open OPAC</a>
        </div>
        <div class="feature-card">
            <h2>Reserve a room</h2>
            <p>Book an available library room using the online reservation page.</p>
            <a href="{{ route('rooms.book') }}" class="feature-link">Reserve now</a>
        </div>
        <div class="feature-card">
            <h2>Send feedback</h2>
            <p>Share comments and suggestions to help improve library services.</p>
            <a href="{{ route('feedback.create') }}" class="feature-link">Leave feedback</a>
        </div>
    </section>

    <section class="vmg-section" id="about">
        <div class="vmg-container">
            <div class="vmg-top">
                <div class="vmg-row">
                    <h2 class="vmg-label">VISION</h2>
                    <p class="vmg-text">To be the institution of higher learning recognized for affordable academic excellence in its class.</p>
                </div>
                <div class="vmg-row">
                    <h2 class="vmg-label">MISSION</h2>
                    <p class="vmg-text">Caraga Institute of Technology affords top tier education, enhancing the quality of life of its students, teachers, their families and communities.</p>
                </div>
            </div>

            <div class="vmg-goals">
                <h2 class="goals-title">GOALS</h2>
                <div class="goals-grid">
                    <div class="goal-card">
                        <p>To offer top priority courses using results-based instruction, research and community engagement as facilitated by a proficient faculty and staff.</p>
                    </div>
                    <div class="goal-card">
                        <p>To find ways and means to balance the cost of education against the uncompromising high standards in the course offering.</p>
                    </div>
                    <div class="goal-card">
                        <p>To inspire and produce highly-skilled graduates who emerge as productive citizens helping enhance the communities of the Agusan and Caraga region.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="info-programs-section">
        <div class="info-container">
            <div class="info-grid">
                <div class="info-col">
                    <h2 class="info-title">LIBRARY SERVICE HOURS</h2>
                    <p class="schedule-subtitle">Regular Schedule:</p>
                    <p class="info-text">Monday-Friday 8:00AM – 12:00PM / 1:30PM – 7:00PM</p>
                    <p class="info-text">Saturday 8:00AM – 12:00PM</p>
                </div>
                <div class="info-col">
                    <h2 class="info-title">LIBRARY STAFF</h2>
                    <p class="info-text">Margelie H. Munda - Librarian</p>
                    <p class="info-text">Teresita S. Tiape - Librarian Staff</p>
                    <p class="info-text">Marnie Rubi - Librarian Staff</p>
                </div>
            </div>

            <div class="programs-block">
                <h2 class="programs-title">PROGRAMS OFFERED</h2>
                <div class="programs-grid">
                    <article class="program-card">
                        <div class="program-badge">BEED</div>
                        <h3 class="program-name">Bachelor of Elementary Education</h3>
                    </article>
                    <article class="program-card">
                        <div class="program-badge">BSBA</div>
                        <h3 class="program-name">Bachelor of Science in Business Administration</h3>
                    </article>
                    <article class="program-card">
                        <div class="program-badge">CSC</div>
                        <h3 class="program-name">Computer Secretarial Course</h3>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer" id="contact">
        <div class="footer-container">
            <div class="footer-logo-wrapper">
                <img src="{{ $brand['logo_url'] }}" alt="{{ $brand['school_name'] }} seal" class="footer-logo">
            </div>
            <h3 class="footer-title">{{ strtoupper($brand['school_name']) }}</h3>
            <p class="footer-contact">
                National Highway 8609 Kitcharao, Philippines
                <span class="divider">|</span>
                <a href="mailto:citkitcharao.edu.ph@gmail.com">citkitcharao.edu.ph@gmail.com</a>
                <span class="divider">|</span>
                63 905 4894 18
            </p>
            <div class="footer-links">
                <a href="#about">About</a>
                <a href="{{ route('landing') }}">OPAC</a>
                <a href="{{ route('rooms.book') }}">Room Reservations</a>
                <a href="{{ route('feedback.create') }}">Feedback</a>
                <a href="{{ route('login') }}">Login</a>
            </div>
            <hr class="footer-divider">
            <p class="footer-copyright">{{ $brand['system_name'] }} © 2026. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>