<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Fasilitas</title>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/software-download.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('style/admin/dashboard.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
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
            <a href="{{ route('admin.dashboard') }}" class="buttn" id="dashboardButton">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a :href="route('logout')" class="buttnlogout"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="title">Halo, Admin Fasilitas</div>
        <div class="sub-title">Berikut merupakan kotak masuk laporanmu</div>
        <div class="search-filter-bar">
            <form method="GET" action="{{ route('admin.dashboard') }}" class="search-bar">
                <input type="text" name="query" id="search-input" placeholder="Search here" value="{{ request('query') }}">
                <div class="filter-bar">
                    <select id="filter-option" onchange="filterReports()">
                        <option value="newest">by latest</option>
                        <option value="highest">by most vote</option>
                    </select>
                </div>
            </form>
        </div>
        @foreach ($reports as $report)
            <div class="report-card" data-date="{{ $report->report_date }}" data-votes="{{ $report->votes }}">
                <a href="{{ route('report.details', ['id' => $report->id]) }}" style="text-decoration: none; color: inherit;">
                    <div class="report-grid">
                        <div class="grid-title">{{ $report->title }}</div>
                        <div class="grid-vote">
                            <div class="vote-count">{{ $report->votes }}<br>vote</div>
                            <button class="btn" onclick="event.stopPropagation();"><i class="gg-software-download"></i></button>
                        </div>
                        <div class="grid-attr">
                            <div class="report-tag">{{ $report->tag }}</div>
                            <div class="report-author">{{ $report->author }}</div>
                            <div class="report-date">{{ \Carbon\Carbon::parse($report->report_date)->format('d M Y') }}</div>
                        </div>
                        <div class="grid-status-wrapper">
                            <div class="grid-status {{ $report->status == 'Sedang Ditindaklanjuti' ? 'status-in-progress' : 'status-completed' }}">
                                {{ $report->status }}<br>{{ now()->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="report-desc">
                        <p>{{ \Illuminate\Support\Str::limit($report->description, 500) }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <script>
        $(document).ready(function() {
            $('#updateForm').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            var reportId = response.report.id;
                            var newStatus = response.report.status;
                            var newStatusDesc = response.report.status_desc;

                            // Update the status in the dashboard
                            $('.report-card').each(function() {
                                if ($(this).data('id') == reportId) {
                                    $(this).find('.grid-status').text(newStatus + '\n' + newStatusDesc);
                                    $(this).find('.grid-status').removeClass('status-in-progress status-completed');
                                    if (newStatus == 'Sedang Ditindaklanjuti') {
                                        $(this).find('.grid-status').addClass('status-in-progress');
                                    } else {
                                        $(this).find('.grid-status').addClass('status-completed');
                                    }
                                }
                            });

                            $('#updateModal').modal('hide');
                        }
                    },
                    error: function(response) {
                        // Handle error
                    }
                });
            });
        });
        
        $(document).ready(function() {
            // Fungsi untuk mengirim permintaan AJAX saat mengklik tombol update status
            $('.update-status-btn').click(function(e) {
                e.preventDefault();
                var reportId = $(this).data('report-id');
                var newStatus = $(this).data('new-status');

                $.ajax({
                    url: '/reports/' + reportId + '/update-status', // Sesuaikan dengan URL endpoint update status
                    type: 'PUT', // Metode HTTP yang digunakan, bisa POST atau PUT tergantung konfigurasi Anda
                    data: {
                        status: newStatus,
                        // Jika ada deskripsi status, tambahkan di sini
                        // status_desc: 'Deskripsi status baru'
                    },
                    success: function(response) {
                        // Sukses, perbarui tampilan tanpa refresh
                        var updatedReport = response.report;
                        $('#report-status-' + reportId).text(updatedReport.status);
                        // Jika ada deskripsi status, perbarui juga
                        // $('#report-status-desc-' + reportId).text(updatedReport.status_desc);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating status:', error);
                        // Handle error jika diperlukan
                    }
                });
            });
        });
    </script>
</body>
</html>