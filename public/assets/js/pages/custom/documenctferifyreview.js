   $(document).ready(function() {
    $(document).on('change', 'input[id^="reject"]', function() {
      if ($(this).is(':checked')) {
        var confirmation = confirm("Apakah Anda yakin mereject data ini ?");
        if (confirmation) {
          var detailId = $(this).data('id');
           var dovValue = $("#DOV" + detailId).val();
         
          updateDOV(dovValue, detailId, 3)
        } else {
          $(this).prop('checked', false);
          $(this).val(0);
        }
      } else {
        $(this).val(0);
      }
    });
    $(document).on('change', 'input[id^="reset"]', function() {
      if ($(this).is(':checked')) {
        var confirmation = confirm("Apakah Anda yakin reset data ini ?");
        if (confirmation) {
          var detailId = $(this).data('id');
           var dovValue = $("#DOV" + detailId).val();
         
          updateDOV(dovValue, detailId, 2 )
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
      updateDOV(dovValue, detailId,1)
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
      review: (reset > 0 ? reset : 0) // 1 => approved | 3 => reject | 1 => reset
    };
    console.log(data)
    $.ajax({
      url: '/update-dov',
      method: 'POST',
      data: data,
      success: function(response) {
        if (response.review == 1) {
          $("#Rejected" + detailId).addClass("d-none");
          $("#isRejected" + detailId).addClass("d-none");
          $("#isApporv" + detailId).removeClass("d-none");
        } else if (response.review == 3) {
          console.log("is rejectd")
          $("#isApporv" + detailId).addClass("d-none");
          $("#Rejected" + detailId).addClass("d-none");
          $("#isRejected" + detailId).removeClass("d-none");
        } else {
          $("#Rejected" + detailId).removeClass("d-none");
          $("#isApporv" + detailId).addClass("d-none");
          $("#isRejected" + detailId).addClass("d-none");
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