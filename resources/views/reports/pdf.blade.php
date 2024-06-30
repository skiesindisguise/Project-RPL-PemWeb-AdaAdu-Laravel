<h1>Report - {{ $report->id }}</h1>
<h3>{{ $report->title }}</h3>
<p>{{ $report->tag }}</p>
<p>{{ $report->author }}</p>
<p>{{ \Carbon\Carbon::parse($report->report_date)->format('d M Y') }}</p>
<p>{{ $report->description }}</p>
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