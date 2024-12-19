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