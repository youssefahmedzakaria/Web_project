function uploadImage() {
    var formData = new FormData();
    var imageFile = document.querySelector('input[type="file"]');
    formData.append("image", imageFile.files[0]);

    $.ajax({
        url: "upload.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            alert(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}