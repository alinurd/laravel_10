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