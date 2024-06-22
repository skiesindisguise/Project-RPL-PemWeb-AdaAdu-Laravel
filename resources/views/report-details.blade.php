<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/software-download.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="reportdetails-umum.css">
    <script src="https://kit.fontawesome.com/22694d56fe.js" crossorigin="anonymous"></script>
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
            <a href="../faqih/view-report-umum.html" class="buttn">View Report</a>
            <a href="../fajar/dashboardamin.html" class="buttn">Dashboard</a>
        </div>
    </div>
    <div class="container">
        <div class="report-title" id="report-title"></div>
        <div class="vote-download">
            <div class="vote-count" id="vote-count"></div>
            <button class="btn"><i class="fa-solid fa-circle-up fa-2xl" style="color: #1491ec;"></i></button>
        </div>
        <div class="report-attr">
            <div id="report-tag">Fasilitas</div>
            <div id="report-author"></div>
            <div id="report-date"></div>
        </div>
        <button class="status" id="report-status" data-toggle="modal" data-target="#statusModal"></button>
        <div class="report-desc" id="report-desc"></div>
        <img id="report-image" class="report-image" src="../assets/reportimageex.jpg" alt="Report Image">
        
    </div>

    <!-- Modal -->
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
                <div class="modal-status-desc">Nanti penjelasan progress di sini</div>
            </div>
          </div>
        </div>
    </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
      <script src="reportdetails-umum.js"></script>
</body>
</html>
