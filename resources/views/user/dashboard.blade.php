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
        <div class="title">Halo, {{ Auth::user()->name }}</div>
        <div class="sub-title">Berikut merupakan riwayat laporanmu</div>
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
        @forelse (auth()->user()->reports as $report)
            <div class="report-card" data-date="{{ $report->report_date }}" data-votes="{{ $report->votes }}">
                <a href="{{ route('reports.show', $report->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="report-grid">
                        <div class="grid-title">{{ $report->title }}</div>
                        <div class="grid-vote">
                            <div class="vote-count">{{ $report->votes }}<br>vote</div>
                            <button class="btn-trash"><i class="fa-solid fa-trash fa-2xl" style="color: #444444;"></i></button>
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
        @empty
            <div class="alert alert-danger">
                Anda belum pernah membuat laporan.
            </div>
        @endforelse
        <a class="floating-add-button" id="createReportButton" href="{{ route('reports.create') }}">
            <i class="fa-solid fa-circle-plus fa-2xl" style="color: #1491ec;"></i>
        </a>
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
      <script>
        document.getElementById('createReportButton').addEventListener('click', function() {
            window.location.href = "{{ route('reports.create') }}";
        });
    </script>
</body>
</html>