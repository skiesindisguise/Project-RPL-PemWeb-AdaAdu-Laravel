<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style/user/dashboard.css') }}">
    <script src="https://kit.fontawesome.com/22694d56fe.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <a href="#" class="buttn" id="viewReportButton">View Report</a>
            <a href="#" class="buttn" id="dashboardButton">Dashboard</a>
        </div>
    </div>
    <div class="container">
        <div class="title">Halo, Khansa Amani</div>
        <div class="sub-title">Berikut merupakan riwayat laporanmu</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
        <div class="search-filter-bar">
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search here">
            </div>
            <div class="filter-bar">
                <select id="filter-option" onchange="filterReports()">
                    <option value="newest">by latest</option>
                    <option value="highest">by most vote</option>
                </select>
            </div>
        </div>
        <div class="report-card" data-date="2023-05-04" data-votes="10" onclick="viewReportDetails(this)">
            <div class="meta">
                <div>
                    <div class="report-title">AC Gedung B Ruang B406 FATISDA Kurang Dingin</div>
                    <div class="report-attr">
                        <div class="report-tag">Fasilitas</div>
                        <div class="report-author">Khansa Amani</div>
                        <div class="report-date">04 Mei 2023</div>
                    </div>
                </div>
                <div class="vote">
                    <div class="button">
                        <div class="vote-count">10<br>vote</div>
                        <button class="btn-trash"><i class="fa-solid fa-trash fa-2xl" style="color: #444444;"></i></button>
                    </div>
                    <div class="status status-in-progress">Sedang Ditindaklanjuti | 6 Juni 2024</div>
                </div>
            </div>
            <div class="report-desc">
                <p>Sejak beberapa waktu terakhir, AC di ruangan ini tidak berfungsi dengan baik sehingga suhu ruangan menjadi kurang dingin dan tidak nyaman untuk kegiatan belajar mengajar maupun aktivitas lainnya. Hal ini sangat mengganggu kenyamanan dan produktivitas kami. Mohon kiranya pihak pemeliharaan dapat segera menindaklanjuti dan memperbaiki masalah ini agar kegiatan dapat berjalan dengan lancar.</p>
            </div>
        </div>
        <div class="report-card" data-date="2024-02-03" data-votes="100" onclick="viewReportDetails(this)">
            <div class="meta">
                <div>
                    <div class="report-title">AC Gedung B Ruang B406 FATISDA Kurang Dingin</div>
                    <div class="report-attr">
                        <div class="report-tag">Fasilitas</div>
                        <div class="report-author">Khansa Amani</div>
                        <div class="report-date">03 Februari 2024</div>
                    </div>
                </div>
                <div class="vote">
                    <div class="button">
                        <div class="vote-count">100<br>vote</div>
                        <button class="btn-trash"><i class="fa-solid fa-trash fa-2xl" style="color: #444444;"></i></button>
                    </div>
                    <div class="status status-completed">Selesai | 5 Juni 2024</div>
                </div>
            </div>
            <div class="report-desc">
                <p>Sejak beberapa waktu terakhir, AC di ruangan ini tidak berfungsi dengan baik sehingga suhu ruangan menjadi kurang dingin dan tidak nyaman untuk kegiatan belajar mengajar maupun aktivitas lainnya. Hal ini sangat mengganggu kenyamanan dan produktivitas kami. Mohon kiranya pihak pemeliharaan dapat segera menindaklanjuti dan memperbaiki masalah ini agar kegiatan dapat berjalan dengan lancar.</p>
            </div>
        </div>
        <div class="report-card" data-date="2025-01-01" data-votes="3" onclick="viewReportDetails(this)">
            <div class="meta">
                <div>
                    <div class="report-title">AC Gedung B Ruang B406 FATISDA Kurang Dingin</div>
                    <div class="report-attr">
                        <div class="report-tag">Fasilitas</div>
                        <div class="report-author">Khansa Amani</div>
                        <div class="report-date">01 Januari 2025</div>
                    </div>
                </div>
                <div class="vote">
                    <div class="button">
                        <div class="vote-count">3<br>vote</div>
                        <button class="btn-trash"><i class="fa-solid fa-trash fa-2xl" style="color: #444444;"></i></button>
                    </div>
                    <div class="status status-completed">Selesai | 5 Juni 2024</div>
                </div>
            </div>
            <div class="report-desc">
                <p>Sejak b eberapa waktu terakhir, AC di ruangan ini tidak berfungsi dengan baik sehingga suhu ruangan menjadi kurang dingin dan tidak nyaman untuk kegiatan belajar mengajar maupun aktivitas lainnya. Hal ini sangat mengganggu kenyamanan dan produktivitas kami. Mohon kiranya pihak pemeliharaan dapat segera menindaklanjuti dan memperbaiki masalah ini agar kegiatan dapat berjalan dengan lancar.</p>
            </div>
        </div>
        <button class="floating-add-button" id="createReportButton"><i class="fa-solid fa-circle-plus fa-2xl" style="color: #1491ec;"></i></button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div>Hapus laporan ini?</div>
                <div class="report-title" id="modal-report-title"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-delete" data-dismiss="modal">Delete</button>
              </div>
          </div>
        </div>
    </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
      <script src="dashboard-user.js"></script>
</body>
</html>