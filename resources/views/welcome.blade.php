<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdaAdu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/index.css') }}">
    <script src="https://unpkg.com/scrollreveal"></script>
</head>

<body>
    <div class="header">
        <div class="logo-row">
            <div class="logo-column">
                <img src="{{ asset('images/logo-adaadu-svg.svg') }}" alt="adaadu">
            </div>
            <div class="logo-column">
                <img src="{{ asset('images/logo-uns-svg.svg') }}" alt="logouns">
            </div>
        </div>
        <div class="nav">
            <a href="#main-section" class="buttn btnHome" id="home">Home</a>
            <a href="#about-section" class="buttn btnAbout" id="about">About</a>
            <a href="#footer-contact" class="buttn btnContact" id="contact">Contact</a>
            @if (Route::has('login'))
                @auth
                    @can('isAdmin')
                    <a href="{{ route('admin.dashboard') }}" class="buttn" id="dashboard-admin">Dashboard</a>
                    @endcan
                    @can('isUser')
                    <a href="{{ route('user.dashboard') }}" class="buttn" id="dashboard-user">Dashboard</a>
                    @endcan
                @else
                    <a href="{{ route('login') }}" class="buttn" id="login">Login</a>
                @endauth
            @endif
        </div>
    </div>

    <!-- Main Section -->
    <section id="main-section" class="main-section text-center py-5">
        <h1 class="display-4">AdaAdu</h1>
        <p class="slogan">Semua Terbantu!</p>
        <p class="intro">Layanan Pengaduan Civitas Akademika UNS</p>
        <p class="intro-adaadu">Laporkan masalah sarana prasarana kampus, kasus perundungan, <br>
            kasus pelecehan dan kekerasan seksual di lingkungan kampus UNS disini!</p>
        <div class=""></div>
        @if (Route::has('login'))
                @auth
                    @can('isAdmin')
                    <a href="{{ route('admin.dashboard') }}" class="btn-report-now">Lapor Sekarang</a>
                    @endcan
                    @can('isUser')
                    <a href="{{ route('user.dashboard') }}" class="btn-report-now">Lapor Sekarang</a>
                    @endcan
                @else
                    <a href="{{ route('login') }}" class="btn-report-now">Lapor Sekarang</a>
                @endauth
            @endif
    </section>

    <!-- About Section -->
    <div id="about-section" class="bg-main-content">
        <h2 class="title-what-is-adaadu">Apa itu <br> AdaAdu?</h2>
        <p class="adaadu-desc">AdaAdu merupakan platform pengaduan masalah berbasis website untuk
            civitas akademika UNS. Seluruh
            civitas akademika UNS dapat membuat, melihat, dan mengawal laporan mengenai berbagai
            permasalahan di lingkungan kampus dari tingkat pusat hingga fakultas.</p>
        <div class="list-adaadu">
            <img src="{{ asset('images/Intimidasi-card.png') }}" alt="intimidasi">
            <img src="{{ asset('images/bullying-card.png') }}" alt="bullying">
            <img src="{{ asset('images/kekerasan-seksual-card.png') }}" alt="kekerasan-seksual">
            <img src="{{ asset('images/fasilitas-card.png') }}" alt="kerusakan-fasilitas">
        </div>
    </div>

    <!-- Testimonials Section -->
    <section class="testimonials-section py-5">
        <div class="container">
            <h2 class=" mb-4">Apa Kata Mereka <br> Tentang AdaAdu</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">"Website pengaduan kampus ini sangat membantu! Kerusakan fasilitas cepat
                                ditangani. Luar biasa!"</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('images/faj.jpg') }}" class="rounded-circle mr-3" alt="Testimonial 1" width="80"
                                    height="80">
                                <div>
                                    <h5 class="card-title">Putra Fajar</h5>
                                    <p class="card-subtitle text-muted">Informatic Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">"Merasa lebih aman dengan adanya platform ini untuk melaporkan segala
                                bentuk kejahatan. Terima kasih!"</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('images/kha.jpg') }}" class="rounded-circle mr-3" alt="Testimonial 2" width="80"
                                    height="80">
                                <div>
                                    <h5 class="card-title">Khansa Amani</h5>
                                    <p class="card-subtitle text-muted">Informatic Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">"Proses pelaporan masalah di kampus jadi lebih mudah dan cepat. Sangat
                                memuaskan!"</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('images/faq.jpg') }}" class="rounded-circle mr-3" alt="Testimonial 3" width="80"
                                    height="80">
                                <div>
                                    <h5 class="card-title">Faqih Khawarizmi</h5>
                                    <p class="card-subtitle text-muted">Informatic Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer-contact" class="footer">
        <div class="section">
            <img src="{{ asset('images/logo-adaadu-svg.svg') }}" alt="AdaAdu">
            <img src="{{ asset('images/logo-uns-svg.svg') }}" alt="Another Logo">
            <img src="{{ asset('images/logo-stopKS-svg.svg') }}" alt="Handshake">
            <img src="{{ asset('images/logo-stopBully-svg.svg') }}" alt="Stop Bullying">
        </div>
        <div class="section contact">
            <h3>Contact</h3>
            <p>+123 456 789</p>
            <p>adaaduuns@mail.uns.ac.id</p>
            <p>WA (+62) 851 5672 3341</p>
        </div>
        <div class="section office">
            <h3>Office</h3>
            <p>Jalan Ir. Sutami 36</p>
            <p>Kentingan, Jebres,</p>
            <p>Surakarta, Jawa Tengah.</p>
            <p>Indonesia 57126.</p>
        </div>
        <div class="section social-icons">
            <h3>Follow Us</h3>
            <a href="#"><img src="{{ asset('images/logo-ig-svg.svg') }}" alt="Instagram"></a>
            <a href="#"><img src="{{ asset('images/logo-fb-svg.svg') }}" alt="Facebook"></a>
            <a href="#"><img src="{{ asset('images/logo-twitter-svg.svg') }}" alt="Twitter"></a>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        ScrollReveal().reveal('.main-section', { delay: 1000 });
        ScrollReveal().reveal('.bg-main-content', { delay: 1000 });
        ScrollReveal().reveal('.testimonials-section', { delay: 1000 });
    </script>
</body>
</html>
