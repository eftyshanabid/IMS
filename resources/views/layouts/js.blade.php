<!-- Vendor js -->
<script src="{{ url('backend') }}/assets/js/vendor.min.js"></script>
<!-- Daterangepicker js -->
<script src="{{ url('backend') }}/assets/vendor/daterangepicker/moment.min.js"></script>
<script src="{{ url('backend') }}/assets/vendor/daterangepicker/daterangepicker.js"></script>
<!-- Apex Charts js -->

<!-- Vector Map js -->
<script src="{{ url('backend') }}/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js">
</script>
<script
    src="{{ url('backend') }}/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

@if(Route::currentRouteName()=='dashboard')
    <script src="{{ url('backend') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('backend') }}/assets/js/pages/demo.dashboard.js"></script>
@endif
<!-- Dashboard App js -->

<!-- App js -->
<script src="{{ url('backend') }}/assets/js/app.js"></script>
<script src="{{ url('backend') }}/assets/vendor/jquery-toast-plugin/jquery.toast.min.js"></script>

<!-- Datatables js -->
<script src="{{ url('backend') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('backend') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ url('backend') }}/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js">
</script>
<script src="{{ url('backend') }}/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js">
</script>

<!--  Select2 Js -->
<script src="{{ url('backend') }}/assets/vendor/select2/js/select2.min.js"></script>
<script src="{{ url('backend') }}/assets/js/sweetalert.min.js"></script>

<!-- datatable-exportable CDN -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/fc-3.3.1/fh-3.1.7/r-2.2.5/sc-2.0.2/datatables.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
<script src="{{url('/')}}/backend/assets/vendor/simplemde/simplemde.min.js"></script>
<script src="{{asset(url('backend/assets/vendor/summernote/summernote-lite.js'))}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

@yield('javascript')
<script !src>
    !(function (c) {
        "use strict";

        function t() {
        }

        (t.prototype.send = function (t, o, i, e, n, a, s, r) {
            t = {
                heading: t,
                text: o,
                position: i,
                loaderBg: e,
                icon: n,
                hideAfter: (a = a || 3e3),
                stack: (s = s || 1)
            };
            (t.showHideTransition = r || "fade"), c.toast().reset("all"), c.toast(t);
        }),
            (c.NotificationApp = new t()),
            (c.NotificationApp.Constructor = t),

            @if (Session::has('message'))
            c.NotificationApp.send("{{ ucfirst(Session::get('alert-type')) }}", "{{ Session::get('message') }}",
                "top-right", "rgba(0,0,0,0.2)", "{{ Session::get('alert-type') }}");
        @elseif (count($errors) > 0)
        @foreach ($errors->all() as $error)
        c.NotificationApp.send("Error", "{{ $error }}", "top-right", "rgba(0,0,0,0.2)", "error");
        @endforeach
        @endif

        $(".select2").each(function() {
            $(this).select2({
              dropdownParent: $(this).parent()
            });
          });

          $(".select2bs4").each(function() {
            $(this).select2({
              theme: "bootstrap4",
              dropdownParent: $(this).parent()
            });
          });

          $(".select2bs4-tags").each(function() {
            $(this).select2({
              tags: true,
              // theme: "bootstrap4",
              // dropdownParent: $(this).parent()
            });
          });

    })(window.jQuery);

    function notify(message, type) {
        swal({
            icon: type,
            text: message,
            button: false
        });
        setTimeout(() => {
            swal.close();
        }, 1500);
    }

    $(document).ready(function () {
        var datatable_file_name = $('.datatable-exportable').attr('data-table-name');
        var table = $('.datatable-exportable').DataTable({
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                ['5 rows', '10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
            ],

            language: {
                emptyTable: "No data available right now"
            },

            iDisplayLength: -1,

            // sScrollX: "100%",

            sScrollXInner: "100%",
            scrollCollapse: true,

            paging: false,
            //ordering: false,
            info: false,

            dom: 'Bfrtip',
            buttons: [
                // 'pageLength',
                {
                    extend: 'copy',
                    title: datatable_file_name
                },
                {
                    extend: 'print',
                    title: datatable_file_name
                },
                {
                    extend: 'csv',
                    filename: datatable_file_name
                },
                {
                    extend: 'excel',
                    filename: datatable_file_name
                },
                {
                    extend: 'pdf',
                    filename: datatable_file_name
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed four-column',
                    attr: {
                        id: 'ColumnsButton'
                    },
                }
            ],

            "columnDefs": [{
                "targets": <?php echo json_encode(userColumnVisibilities()); ?>,
                "visible": false
            }]
        });

        $('.buttons-collection').addClass('btn-sm');
        $('.buttons-copy').removeClass('btn-secondary').addClass('btn-sm btn-warning').html(
            '<i class="mdi mdi-content-copy"></i>').attr('title', "Copy");
        $('.buttons-csv').removeClass('btn-secondary').addClass('btn-sm btn-success').html(
            '<i class="mdi mdi-google-spreadsheet"></i>').attr('title', "CSV");
        $('.buttons-excel').removeClass('btn-secondary').addClass('btn-sm btn-primary').html(
            '<i class="mdi mdi-microsoft-excel"></i>').attr('title', "Excel");
        $('.buttons-pdf').removeClass('btn-secondary').addClass('btn-sm btn-dark').html(
            '<i class="mdi mdi-file-pdf-box"></i>').attr('title', "PDF");
        $('.buttons-print').removeClass('btn-secondary').addClass('btn-sm btn-dark').html(
            '<i class="mdi mdi-printer"></i>').attr('title', "Print");
        $('.buttons-colvis').addClass('btn-sm').html('<i class="mdi mdi-database-eye"></i>').attr('title',
            "Column Visibility");

        $('.datatable-exportable').parent().addClass('table-responsive');

        $('.datatable-exportable').on('column-visibility.dt', function (e, settings, column, state) {
            var columns = [];
            $.each($('.buttons-columnVisibility'), function (index, val) {
                columns.push($(this).hasClass('active'));
            });

            $.ajax({
                url: "{{ url('admin/update-user-column-visibilities') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    url: location.href,
                    columns: columns
                },
            });
        });

        $('.word-restrictions').on("keyup change", function (e) {
            var restrictions = "{{ implode(',', wordRestrictions()) }}".split(',');
            var input = $(this);
            $.each(restrictions, function (index, restriction) {
                input.val(input.val().replace(new RegExp(restriction, "ig"), ''));
            });
        });
    });

    $(document).ready(function () {
        $('.summernote').summernote({
            height: "150px"
        });
    });

    function Show(button) {
        $('#myModal-title').html(button.attr('data-title'));
        $.ajax({
            url: button.attr('data-src'),
            type: 'GET',
            data: {},
        })
            .done(function (response) {
                $('#myModal-body').html(response);
                $('#myModal').modal('show');
            });
    }
</script>

