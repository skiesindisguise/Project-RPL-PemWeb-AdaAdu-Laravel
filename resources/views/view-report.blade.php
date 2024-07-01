<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style/view-report.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
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
            <form method="GET" action="{{ route('viewwreport') }}" class="search-bar">
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
            <div class="report-card" data-date="{{ $report->report_date }}" data-votes="{{ $report->votes}}" data-id="{{ $report->id }}">
                    <div class="report-grid">
                        <a href="{{ route('reports.show', $report->id) }}" style="text-decoration: none; color: inherit;">
                            <div class="grid-title">{{ $report->title }}</div>
                        </a>
                        <div class="grid-vote">
                            <div class="vote-count" id="vote-count-{{ $report->id }}">{{ $report->votes}}<br>vote</div>
                            @if (auth()->user()->role == 'user')
                                <button class="vote-btn" data-report-id="{{ $report->id }}"><i class="fa-solid fa-circle-up fa-2xl" style="color: #1491ec;"></i></button>
                            @else
                                <button class="btn"><i class="fa-solid fa-circle-up fa-2xl" style="color: #4444;"></i></button>
                            @endif
                        </div>
                        <a href="{{ route('reports.show', $report->id) }}" style="text-decoration: none; color: inherit;">
                            <div class="grid-attr">
                                <div class="report-tag">{{ $report->tag }}</div>
                                <div class="report-author">{{ $report->author }}</div>
                                <div class="report-date">{{ \Carbon\Carbon::parse($report->report_date)->format('d M Y') }}</div>
                            </div>
                        </a>
                        <div class="grid-status-wrapper">
                            <div
                            class="grid-status {{ $report->status == 'Sedang Ditindaklanjuti' ? 'status-in-progress' : ($report->status == 'Belum Ditindaklanjuti' ? 'status-not-in-progress' : 'status-completed') }}">
                            {{ $report->status }}
                            @if($report->status != 'Belum Ditindaklanjuti')
                                <br>{{ now()->format('d M Y') }}
                            @endif
                        </div>
                        
                        </div>
                    </div>
                    <a href="{{ route('reports.show', $report->id) }}" style="text-decoration: none; color: inherit;">
                        <div class="report-desc">
                            <p>{{ \Illuminate\Support\Str::limit($report->description, 500) }}</p>
                        </div>
                    </a>
            </div>
            <!-- Modal -->
        <div class="modal fade" id="statusModal-{{ $report->id }}" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Report Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="report-title" id="modal-report-title"></div>
                            <div class="modal-status" id="modal-report-status"></div>
                            <div class="grid-status-wrapper">
                                <div
                                class="grid-status {{ $report->status == 'Sedang Ditindaklanjuti' ? 'status-in-progress' : ($report->status == 'Belum Ditindaklanjuti' ? 'status-not-in-progress' : 'status-completed') }}">
                                {{ $report->status }}
                                @if($report->status != 'Belum Ditindaklanjuti')
                                    <br>{{ now()->format('d M Y') }}
                                @endif
                            </div>
                            
                                <div class="modal-status-desc">
                                    <br>
                                    <p>Informasi:<br>{{ $report->status_desc }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        $(document).ready(function() {
            // Function to update vote counts
            function updateVoteCounts() {
                $('.report-card').each(function() {
                    var reportId = $(this).data('id');
                    $.ajax({
                        url: '/reports/' + reportId + '/votes-count',
                        method: 'GET',
                        success: function(response) {
                            $('#vote-count-' + reportId).html(response.votes_count + '<br>vote');
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });
            }

            setInterval(updateVoteCounts, 5000);
        });
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
                        button.closest('.vote-download').find('.vote-count').html(response
                            .votes_count + '<br>vote');
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
