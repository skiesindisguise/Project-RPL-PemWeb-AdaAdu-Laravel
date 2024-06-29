<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/software-download.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style/admin/report-details.css') }}">
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
            <a href="{{ route('admin.viewreport') }}" class="buttn" id="viewReportButton">View Report</a>
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
        <div class="report-title" id="report-title">{{ $report->title }}</div>
        <div class="vote-download">
            <div class="vote-count" id="vote-count">{{ $report->votes }} votes</div>
            <button class="btn-download"><i class="gg-software-download"></i></button>
        </div>
        <div class="report-attr">
            <div id="report-tag">{{ $report->tag }}</div>
            <div id="report-author">{{ $report->author }}</div>
            <div id="report-date">{{ \Carbon\Carbon::parse($report->report_date)->format('d M Y') }}</div>
        </div>
        <div class="status {{ $report->status == 'Sedang Ditindaklanjuti' ? 'status-in-progress' : 'status-completed' }}" id="report-status" data-toggle="modal" data-target="#statusModal">{{ $report->status }}<br>{{ now()->format('d M Y') }}</div>
        <div class="report-desc" id="report-desc">{{ $report->description }}</div>
        @if ($report->photo)
            @php
                $photo_path = '/reports/user_' . $report->user->id . '/' . $report->photo;
            @endphp
            @if (Storage::exists('public/' . $photo_path))
                <img id="report-image" class="report-image" src="{{ asset('storage/' . $photo_path) }}" alt="Report Image">
            @elseif (filter_var($report->photo, FILTER_VALIDATE_URL))
                <img id="report-image" class="report-image" src="{{ $report->photo }}" alt="Report Image">
            @endif
        @else
            <img id="report-image" class="report-image" src="{{ asset('images/default-report-image.jpg') }}" alt="Report Image">
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
