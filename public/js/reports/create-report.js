function displayFileName() {
    var input = document.getElementById('upload');
    var fileName = input.files[0].name;
    document.getElementById('file-name').textContent = fileName;
}