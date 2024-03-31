<div class="row pt-2 pl-3">
    @if (!isset($searchHide) || !$searchHide)
        <div class="col-md-4 pt-1 pl-0">
            <button class="btn btn-sm btn-block btn-success report-button" type="submit"><i
                    class="mdi mdi-magnify search-icon"></i>&nbsp;Search</button>
        </div>
    @endif

    @if (!isset($clearHide) || !$clearHide)
        <div class="col-md-4 pt-1 pl-0">
            <a class="btn btn-sm btn-block btn-danger" href="{{ explode('?', $url)[0] }}"><i
                    class="mdi mdi-calendar-remove-outline"></i>&nbsp;Clear</a>
        </div>
    @endif

    {{-- <div class="col-md-{{ !(!isset($searchHide) || !$searchHide) ? 4 : 2 }} pt-1 pl-0">
        <button class="btn btn-sm btn-block btn-success" type="button" onclick="viewPDFReport()"><i
                class="mdi mdi-file-pdf-box"></i>&nbsp;PDF</button>
    </div>

    <div class="col-md-{{ !(!isset($searchHide) || !$searchHide) ? 4 : 2 }} pt-1 pl-0">
        <button class="btn btn-sm btn-block btn-primary" type="button"
            onclick="exportReportToExcel('{{ $title }}')"><i
                class="mdi mdi-file-excel-box"></i>&nbsp;Excel</button>
    </div> --}}
</div>

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            var form = $('#report-form');
            var button = $('.report-button');

            var from = "{{ request()->has('from') }}";
            if (from == 1) {
                loadReport(form, button);
            }

            form.on('submit', function(e) {
                form.attr('formtarget', '_parent');
                e.preventDefault();

                loadReport(form, button)
            });
        });

        function loadReport(form, button) {
            $('#report_type').val('report');

            button.prop('disabled', true).html('<i class="uil uil-spin"></i>&nbsp;Please Wait...');
            $('.report-view').html(
                '<h3 class="text-center"><strong><i class="uil uil-spin"></i>&nbsp; Please Wait...</strong></h3>')
            .show();
            $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serializeArray(),
                })
                .done(function(response) {
                    button.prop('disabled', false).html('<i class="uil uil-search-alt"></i>&nbsp;Search');
                    $('.report-view').html(response);
                })
                .fail(function(response) {
                    button.prop('disabled', false).html('<i class="uil uil-search-alt"></i>&nbsp;Search');
                    $('.report-view').html(response).hide();
                });
        }

        // function viewPDFReport() {
        //     var form = $('#report-form');
        //     $('#report_type').val('pdf');

        //     var link = form.attr('action') + '?';
        //     $.each(form.serializeArray(), function(index, val) {
        //         link += val['name'] + '=' + val['value'] + '&';
        //     });

        //     window.open(link, '_blank');
        // }

        // function exportReportToExcel(filename = '') {
        //     var downloadLink;
        //     var dataType = 'application/vnd.ms-excel';
        //     let tableSelect = document.querySelector(".export-table");
        //     var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        //     filename = filename ? filename + '.xls' : 'Report.xls';
        //     downloadLink = document.createElement("a");

        //     document.body.appendChild(downloadLink);

        //     if (navigator.msSaveOrOpenBlob) {
        //         var blob = new Blob(['\ufeff', tableHTML], {
        //             type: dataType
        //         });
        //         navigator.msSaveOrOpenBlob(blob, filename);
        //     } else {
        //         downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        //         downloadLink.download = filename;
        //         downloadLink.click();
        //     }
        // }
    </script>
@endsection
