   $(document).ready(function() {
    $(document).on('change', '.code-switcher', function() {
      if ($(this).is(':checked')) {
        var confirmation = confirm("Apakah Anda yakin ?");
        if (confirmation) {
          var detailId = $(this).data('id');
          var dovValue = $("#DOV" + detailId).val();
          updateDOV(dovValue, detailId, 1)
        } else {
          $(this).prop('checked', false);
          $(this).val(0);
        }
      } else {
        $(this).val(0);
      }
    });

    $(document).on('change', 'input[id^="DOV"]', function() {
      var dovValue = $(this).val();
      var detailId = $(this).data('id');
      
    var reset = $("#reset" + detailId).val();
      updateDOV(dovValue, detailId,reset)
    });
  });

  function showSpinner(elementId) {
    $('#' + elementId).removeClass('d-none');  
  }
  function hideSpinner(elementId) {
    $('#' + elementId).addClass('d-none');  
  }
  $(document).on('click', '.toggleHeader', function() {
    var tableId = $(this).data('id');
    var key = $(this).data('key');
    var headerRow = $('#header-row-' + tableId);
    headerRow.toggle();
  });

  function updateDOV(dovValue, detailId, reset) {
    var dovValue = dovValue;
    var detailId = detailId;
    var reset = reset;
    var spinnerId = 'spinner' + detailId;
    var ket_review = $("#review" + detailId).val();
    
    showSpinner(spinnerId);
    var data = {
      _token: '{{ csrf_token() }}', // CSRF Token Laravel
      id: detailId,
      dov: dovValue,
      ket_review: ket_review,
      reset: reset,
      review: (reset == 1 ? 0 : 1) // 1 => review | 2 => reject | 0 => reset
    };
    $.ajax({
      url: '/update-dov',
      method: 'POST',
      data: data,
      success: function(response) {
        if (response.review) {
          $("#" + detailId).removeClass("d-none");
        } else {
          $("#" + detailId).addClass("d-none");
          $("#review" + detailId).val('');
          $("#DOV" + detailId).val(null);
        }
        hideSpinner(spinnerId);
      },
      error: function(xhr, status, error) {
        hideSpinner(spinnerId);
        console.error('Error updating DOV:', error);
      }
    });
  }