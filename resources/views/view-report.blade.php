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
    <script src="https://kit.fontawesome.com/22694d56fe.js" crossorigin="anonymous"></script>
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
            <a href="{{ route('all.viewreport') }}" class="buttn" id="viewReportButton">View Report</a>
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
<!-- Sesuaikan view-report.blade.php jika diperlukan -->
        @foreach ($reports as $report)
            <div class="report-card" data-date="{{ $report->report_date }}" data-votes="{{ $report->votes()->count() }}">
                <a href="{{ route('reports.show', $report->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="report-grid">
                        <div class="grid-title">{{ $report->title }}</div>
                        <div class="grid-vote">
                            <div class="vote-count">{{ $report->votes()->count() }}<br>vote</div>
                            @if (auth()->user()->role == 'user')
                                <button class="btn"><i class="fa-solid fa-circle-up fa-2xl" style="color: #1491ec;"></i></button>
                            @else
                            <button class="btn"><i class="fa-solid fa-circle-up fa-2xl" style="color: #4444;"></i></button>
                            @endif
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
</body>
</html>