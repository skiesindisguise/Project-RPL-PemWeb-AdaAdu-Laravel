function filterReports() {
    const filterReport = document.getElementById('filter-option').value;
   
    const reports = Array.from(document.querySelectorAll('.report-card'));

    if (filterReport === 'newest') {
        reports.sort((a, b) => new Date(b.dataset.date) - new Date(a.dataset.date));
    } else if (filterReport === 'highest') {
        reports.sort((a, b) => b.dataset.votes - a.dataset.votes);
    }

    const container = document.querySelector('.container');
    const reportCards = container.querySelectorAll('.report-card');
    reportCards.forEach(card => container.removeChild(card));

    reports.forEach(report => container.appendChild(report));
}
