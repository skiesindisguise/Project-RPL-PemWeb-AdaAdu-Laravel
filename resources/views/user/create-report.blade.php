<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan</title>
    <link rel="stylesheet" href="{{ asset('style/user/create-report.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('images/adaadu-svg.svg') }}" alt="Logo">
            <img src="{{ asset('images/logo-uns-svg.svg') }}" alt="Logo">
        </div>
        <div class="nav-links">
            <a href="{{ route('viewwreport') }}" class="buttn">View Report</a>
            <a href="{{ route('user.dashboard') }}" class="dashboard">Dashboard</a>
        </div>
    </div>
    <h2>Buat Laporan</h2>
    <div class="container">
        <form class="report-form" action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="judul" style="font-size: 24px;">Judul</label>
            <input type="text" id="judul" name="title" placeholder="Masukkan Judul">
        
            <label for="tag" style="font-size: 24px; margin-top: 25px;">Tag</label>
            <select id="tag" name="tag" class="tag-dropdown">
                <option value="perkelahian">Perkelahian</option>
                <option value="pembullyan">Pembullyan</option>
                <option value="kekerasan_seksual">Kekerasan Seksual</option>
                <option value="fasilitas">Fasilitas</option>
                <option value="pemalakan">Pemalakan</option>
            </select>
        
            <label for="anonim" style="font-size: 24px; margin-top: 25px;">Anonim</label>
            <select id="anonim" name="anonymous" class="anonim-dropdown">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        
            <label for="public" style="font-size: 24px; margin-top: 25px;">Public</label>
            <select id="public" name="public" class="public-dropdown">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        
            <label for="detail" style="font-size: 24px; margin-top: 25px;">Detail</label>
            <textarea id="detail" name="description" placeholder="Type Detail Report"></textarea>
        
            <label for="upload" class="upload-label" style="font-size: 24px; margin-top: 25px;">Upload Bukti</label>
            <input type="file" id="upload" name="photo" hidden onchange="displayFileName()">
            <button type="button" class="upload-button" onclick="document.getElementById('upload').click();">Choose File</button>
            <span id="file-name"></span>
        
            <div class="buttons">
                <button type="button" class="cancel">Cancel</button>
                <button type="submit" class="submit">Submit</button>
            </div>
        </form>        
        
    </div>
    <script src={{ asset('js/reports/create-report.js') }}></script>
</body>
</html>
