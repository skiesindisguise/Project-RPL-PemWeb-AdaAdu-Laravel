<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/software-download.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style/report-details.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/22694d56fe.js" crossorigin="anonymous"></script>
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
            @if (auth()->user()->role == 'user')
                <button class="vote-btn" data-report-id="{{ $report->id }}"><i class="fa-solid fa-circle-up fa-2xl" style="color: #1491ec;"></i></button>
            @else
                <button class="btn"><i class="fa-solid fa-circle-up fa-2xl" style="color: #4444;"></i></button>
                @endif
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
    <script>
        $(document).ready(function() {
            $('.vote-btn').on('click', function() {
                var button = $(this);
                var reportId = button.data('report-id');

                $.ajax({
                    url: '/reports/' + reportId + '/vote',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        alert(response.success);
                        button.closest('.vote-download').find('.vote-count').html(response.votes_count + '<br>votes');
                    },
                    error: function(response) {
                        console.log(response);
                        alert('An error occurred while voting');
                    }
                });
            });
        });
    </script>
  </body>
</html>
