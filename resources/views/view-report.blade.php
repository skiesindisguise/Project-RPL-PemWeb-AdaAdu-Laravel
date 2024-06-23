<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Fasilitas</title>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/software-download.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="view-report.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="view-report.js"></script>
</head>
<body>
    <div class="header">
        <div class="logo-row">
            <div class="logo-column">
                <img src="../assets/logo-adaadu-svg.svg" alt="adaadu">
            </div>
            <div class="logo-column">
                <img src="../assets/logo-uns-svg.svg" alt="logouns">
            </div>
        </div>
        <div class="nav">
            <a href="#" class="buttn" id="viewReportButton">View Report</a>
            <a href="#" class="buttn" id="dashboardButton">Dashboard</a>
        </div>
    </div>
    <div class="container">
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
                        <button class="btn"><i class="gg-software-download"></i></button>
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
                        <button class="btn"><i class="gg-software-download"></i></button>
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
                        <button class="btn"><i class="gg-software-download"></i></button>
                    </div>
                    <div class="status status-completed">Selesai | 5 Juni 2024</div>
                </div>
            </div>
            <div class="report-desc">
                <p>Sejak beberapa waktu terakhir, AC di ruangan ini tidak berfungsi dengan baik sehingga suhu ruangan menjadi kurang dingin dan tidak nyaman untuk kegiatan belajar mengajar maupun aktivitas lainnya. Hal ini sangat mengganggu kenyamanan dan produktivitas kami. Mohon kiranya pihak pemeliharaan dapat segera menindaklanjuti dan memperbaiki masalah ini agar kegiatan dapat berjalan dengan lancar.</p>
            </div>
        </div>
    </div>
</body>
</html>
