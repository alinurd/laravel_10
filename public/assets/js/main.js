function _formatRupiah(input) { 
    let value = input.value.replace(/[^0-9,-]/g, '');  
     
    let number = value.replace(/,/g, '').replace(/\./g, '');  
    if (number !== '') {
        let formattedValue = Number(number).toLocaleString('id-ID');  
        input.value = formattedValue;
    } else {
        input.value = '';
    }
 }

 function showSpinner(elementId, buttonId) {
    const spinner = $('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
     
    $(buttonId).prop('disabled', true);
    $(elementId).append(spinner);
}

function removeSpinner(elementId, buttonId) {
    $(elementId).find('.spinner-border').remove();
    $(buttonId).prop('disabled', false);
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".ShowLampiran").forEach(function (btn) {
        btn.addEventListener("click", function () {
            let fileName = this.getAttribute("data-original");
            let filePath = this.getAttribute("data-file");
            let modal = new bootstrap.Modal(document.getElementById("modalLampiran"));
            let fileExtension = filePath.split('.').pop().toLowerCase();
        
            let fileUrl = "/assets/upload/lampiran/" + filePath;
        
            document.getElementById("fileName").textContent = fileName;
            let previewImage = document.getElementById("previewImage");
            let downloadFile = document.getElementById("downloadFile");
        
            // Sembunyikan dulu semua elemen
            previewImage.classList.add("d-none");
            downloadFile.classList.add("d-none");
        
            btn.addEventListener("click", function () {
                let fileName = this.getAttribute("data-original");
                let filePath = this.getAttribute("data-file");
                let modal = new bootstrap.Modal(document.getElementById("modalLampiran"));
                let fileExtension = filePath.split('.').pop().toLowerCase();
            
                let fileUrl = "/assets/upload/lampiran/" + filePath;
            
                document.getElementById("fileName").textContent = fileName;
                let previewImage = document.getElementById("previewImage");
                let previewFile = document.getElementById("previewFile");
                let downloadFile = document.getElementById("downloadFile");
            
                // Sembunyikan semua elemen terlebih dahulu
                previewImage.classList.add("d-none");
                previewFile.classList.add("d-none");
                downloadFile.classList.add("d-none");
            
                if (["png", "jpg", "jpeg"].includes(fileExtension)) {
                    // Preview gambar
                    previewImage.src = fileUrl;
                    previewImage.classList.remove("d-none");
                } else if (["pdf"].includes(fileExtension)) {
                    // Preview PDF
                    previewFile.innerHTML = `<iframe src="${fileUrl}" width="100%" height="400px"></iframe>`;
                    previewFile.classList.remove("d-none");
                } else if (["doc", "docx", "xls", "xlsx"].includes(fileExtension)) {
                    // File Word & Excel (tidak bisa dipreview, hanya download)
                    previewFile.innerHTML = `<p>tidak bisa menampilkan file. Silakan download file.</p>`;
                    previewFile.classList.remove("d-none");
                }
            
                // Tombol download
                downloadFile.setAttribute("href", fileUrl);
                downloadFile.setAttribute("download", fileName);
                downloadFile.textContent = "Download " + fileName;
                downloadFile.classList.remove("d-none");
            
                modal.show();
            });
            
        
            modal.show();
        });
        
    });
});
