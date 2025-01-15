<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>

  <meta charset="utf-8" />
  <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

  <!-- custom CSS-->
  @stack('plugin-css')
 
  <!-- Layout config Js -->
  <script src="{{ asset('assets/js/layout.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <!-- Bootstrap CSS -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Icons CSS -->
  <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- App CSS-->
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- custom CSS-->
  <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
  @stack('css')

  <!-- cdn -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>

  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>

  <!-- Begin page -->
  <div id="layout-wrapper">

    <x-dashboard.topbar />
    <!-- ========== App Menu ========== -->
    <x-dashboard.sidebar />
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

      <div class="page-content">
        <div class="container-fluid">

          <!-- start page title -->
          <div class="row">
            <div class="col-12">
              @yield('breadcrumb')
            </div>
          </div>
          <!-- end page title -->
          <x-form.notivication.alert />
          
          @if(isset($mode))
            @if($mode == 'add')
            @if(isset($stm))
            @include('components.form.stm.add')
            @else
            @include('components.form.default.add')
            @endif
            @elseif($mode == 'edit')
            @if(isset($stm))
                @include('components.form.stm.edit')
            @else
               @include('components.form.default.edit')
               @endif
            @elseif($mode == 'show')
            @if(isset($stm))
                @include('components.form.stm.show')
            @else
               @include('components.form.default.show')
               @endif
               
            @else
               @yield('content')
            @endif
          @else
              @yield('content')
          @endif

        </div>
        <!-- container-fluid -->
      </div>
      <!-- End Page-content -->

      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <script>
                document.write(new Date().getFullYear())
              </script> © Velzon.
            </div>
            <div class="col-sm-6">
              <div class="text-sm-end d-none d-sm-block">
                Design & Develop by Themesbrand
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- end main content-->

  </div>
 
  <!-- END layout-wrapper -->
  @if (session('success'))
    <!-- Modal Popup -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('success')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tampilkan modal saat halaman dimuat
        window.onload = function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // Tutup modal setelah 3 detik
            setTimeout(function() {
                successModal.hide();
            }, 3000); // 3000ms = 3 detik
        };
    </script>
@endif



  <!--start back-to-top-->
  <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
  </button>
  <!--end back-to-top-->

  <!-- <div class="customizer-setting d-none d-md-block">
    <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
      <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
    </div>
  </div> -->

  <!-- Theme Settings -->
  <x-dashboard.theme-settings />

  <!-- JAVASCRIPT -->
  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
  <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
  <script src="{{ asset('assets/js/plugins.js') }}"></script>

  <!-- custom JS-->
  @stack('plugin-script')

  <!-- App js -->
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <!-- custom JS-->
  @stack('script')
  <!-- cdn-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


</body>

@yield('jSchart')

<script>
 
  $(document).ready(function() {
    
$('.select2').select2({
        tags: true,
        placeholder: "- Select -",
        allowClear: true,
        width: '100%' 
    });

    $('#data-tables').DataTable({
      info: true,
      ordering: true,
      paging: true,
      footer: true,

      layout: {
        topStart: {
          pageLength: {
            menu: [
              [10, 25, 50, -1],
              [10, 25, 50, 'All']
            ]
          }
        },
        topEnd: {
          search: {
            placeholder: 'search..'
          }
        },
        bottomEnd: {
          paging: {
            buttons: 5
          }
        },

      },

      //   initComplete: function () {
      //     this.api()
      //         .columns()
      //         .every(function () {
      //             let column = this;
      //             let title = column.footer().textContent;
      //             let input = document.createElement('input');
      //             input.placeholder = title;
      //             column.footer().replaceChildren(input);
      //             input.addEventListener('keyup', () => {
      //                 if (column.search() !== this.value) {
      //                     column.search(input.value).draw();
      //                 }
      //             });
      //         });
      // }

    })

    const table = new DataTable('#data-tables');

    table.on('mouseenter', 'td', function() {
      let colIdx = table.cell(this).index().column;

      table
        .cells()
        .nodes()
        .each((el) => el.classList.remove('highlight'));

      table
        .column(colIdx)
        .nodes()
        .each((el) => el.classList.add('highlight'));
    })

    document.querySelectorAll('.column_filter').forEach((el) => {
    let tr = el.closest('tr');
    let columnField = tr.getAttribute('data-column'); // Mengambil nilai 'field' dari data-column
    
    el.addEventListener(el.type === 'text' ? 'keyup' : 'change', () => {
        filterColumn(table, columnField); // Filter berdasarkan field
    });

    $('.filter').click(function() {
        console.log("jalan");
    });
});

function filterColumn(table, field) {
    // Ambil elemen input filter dan cek apakah elemen-elemen tersebut ada
    let filter = document.querySelector('#col' + field + '_filter');
    let regex = document.querySelector('#col' + field + '_regex');
    let smart = document.querySelector('#col' + field + '_smart');

    // Pastikan filter ada sebelum mencoba menggunakannya
    if (filter) {
        let filterValue = filter.value;
        let regexChecked = regex ? regex.checked : false;
        let smartChecked = smart ? smart.checked : false;

        // Terapkan filter pada kolom berdasarkan field
        table.column(field).search(filterValue, regexChecked, smartChecked).draw();
    }
}


  });
</script>
<style>
  .highlight {
    background-color: #d3d3d3;
  }
  .select2-container {
    z-index: 1055; 
}
</style>

</html>