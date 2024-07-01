<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/software-download.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
        <div class="report-title" id="report-title">{{ $report->title }}</div>
        <div class="vote-download">
            <div class="vote-count" id="vote-count">{{ $report->votes }} votes</div>
            <a class="btn-download" href="{{ route('reports.download', $report->id) }}"><i class="gg-software-download"></i></a>
        </div>
        <div class="report-attr">
            <div id="report-tag">{{ $report->tag }}</div>
            <div id="report-author">{{ $report->author }}</div>
            <div id="report-date">{{ \Carbon\Carbon::parse($report->report_date)->format('d M Y') }}</div>
        </div>
        <div class="status 
        {{ $report->status == 'Sedang Ditindaklanjuti'
            ? 'status-in-progress'
            : ($report->status == 'Belum Ditindaklanjuti'
                ? 'status-not-in-progress'
                : 'status-completed') }}"
        id="report-status" data-toggle="modal" data-target="#statusModal">
        {{ $report->status }}
        @if($report->status != 'Belum Ditindaklanjuti')
            <br>{{ now()->format('d M Y') }}
        @endif
    </div>

        <div class="report-desc" id="report-desc">{{ $report->description }}</div>
        @if ($report->photo)
            @php
                $photo_path = '/reports/user_' . $report->user->id . '/' . $report->photo;
            @endphp
            @if (Storage::exists('public/' . $photo_path))
                <img id="report-image" class="report-image" src="{{ asset('storage/' . $photo_path) }}"
                    alt="Report Image">
            @elseif (filter_var($report->photo, FILTER_VALIDATE_URL))
                <img id="report-image" class="report-image" src="{{ $report->photo }}" alt="Report Image">
            @endif
        @else
            <img id="report-image" class="report-image" src="{{ asset('images/default-report-image.jpg') }}"
                alt="Report Image">
        @endif
        <div class="btn-group">
            <button class="btn btn-update" data-toggle="modal" data-target="#updateModal">Update</button>
            <button class="btn btn-delete" data-toggle="modal"
                data-target="#deleteModal-{{ $report->id }}">Delete</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        @csrf
                        <div class="form-group">
                            <label for="status-select">Status</label>
                            <select class="form-control" id="status-select" name="status">
                                <option value="Sedang Ditindaklanjuti">Sedang Ditindaklanjuti</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="update-description">Update Description</label>
                            <textarea class="form-control" id="update-description" name="status_desc" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="updateButton">Update</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
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
                        <div class="grid-status 
                            {{ $report->status == 'Sedang Ditindaklanjuti' ? 'status-in-progress' : 
                            ($report->status == 'Belum Ditindaklanjuti' ? 'status-not-in-progress' : 'status-completed') }}">
                            {{ $report->status }}<br>
                            @if($report->status != 'Belum Ditindaklanjuti')
                                {{ now()->format('d M Y') }}
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
    <div class="modal fade" id="deleteModal-{{ $report->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Hapus laporan ini?</div>
                    <div class="modal-report-title" id="modal-report-title">{{ $report->title }}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updateButton').on('click', function() {
                var formData = {
                    _token: $('input[name=_token]').val(),
                    status: $('#status-select').val(),
                    status_desc: $('#update-description').val()
                };

                $.ajax({
                    url: '{{ route('report.update', ['id' => $report->id]) }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#updateModal').modal('hide');
                        alert(response.success);
                        location.reload();
                    },
                    error: function(response) {
                        alert('An error occurred while updating the report');
                    }
                });
            });
        });
    </script>
</body>

</html>