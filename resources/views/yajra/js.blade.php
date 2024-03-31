<script type="text/javascript">
    $(document).ready(function() {
        var columnVisibilities = <?php echo json_encode(userColumnVisibilities()); ?>;
        var link = "{{ str_replace(url('/').'/', '', request()->url()) }}";
        console.log(link);
        var columns = [];
        if(link != 'admin/applications'){
            columns.push({
                data: 'DT_RowIndex',
                className: 'text-center',
                'orderable': false,
                'searchable': false
            });
        }

        var headerColumns = <?php echo json_encode(isset($headerColumns) ? $headerColumns : []); ?>;
        $.each(headerColumns, function(index, val) {
            var lowest = (link != 'admin/applications' ? 0 : -1);
            if(index > lowest){
                columns.push({
                    data: val[0], 
                    name: val[1],
                    className: val[2],
                });
            }
        });

        var datatable_file_name = $('.datatable-serverside').attr('data-table-name');
        var table = $('.datatable-serverside').DataTable({
            // ordering: false,
            processing: true,
            serverSide: true,
            ajax: location.href,
            columns: columns,

            lengthMenu: [
                [ 50, 100, 500, 1000, -1 ],
                [ '50 rows', '100 rows', '500 rows', '1000 rows', 'All Rows' ]
            ],

            language: {
              emptyTable: "No data available right now"
            },

            "oLanguage": {
               "sSearch": ""
            },
            
            sScrollXInner: "100%",
            scrollCollapse: true,

            dom: 'Bfrtip',
            buttons: [
                'pageLength',
                {
                    extend: 'copy',
                    title: datatable_file_name,
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                          page: 'all',
                        }
                    },
                    "action": serversideDataExport
                },
                {
                    extend: 'print',
                    title: datatable_file_name,
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                          page: 'all',
                        }
                    },
                    "action": serversideDataExport
                },
                {
                    extend: 'csv',
                    filename: datatable_file_name,
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                          page: 'all',
                        }
                    },
                    "action": serversideDataExport
                },
                {
                    extend: 'excel',
                    filename: datatable_file_name,
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                          page: 'all',
                        }
                    },
                    "action": serversideDataExport
                },
                {
                    extend: 'pdf',
                    filename: datatable_file_name,
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                          page: 'all',
                        }
                    },
                    "action": serversideDataExport
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'dropdown',
                }
            ],

            "columnDefs": [{
                "targets": columnVisibilities,
                "visible": false
            }],

            initComplete: function (settings, json) {
                $('.datatable-serverside').find('thead tr th').attr('style', 'padding: 5px !important;');
                var table = this.api();
                // Setup - Replace th with search_text class with input boxes
                table.columns().every(function () {
                    var column = this;
                    var header = $(column.header()).html();
                    var input = $('<input type="text"  style="width: 100% !important;" placeholder="'+header+'"/><span style="display: none">'+header+'</span>')
                        .appendTo($(column.header())
                        .empty());
                    
                    //Restoring state
                    input.val(column.search());
                    
                    //Prevent enter key from sorting column
                    input.on('keypress', function (e) {
                        if (e.which == 13) {
                            e.preventDefault();
                            table.column($(this).parent().index() + ':visible').search(this.value).draw();
                            return false;
                        }
                    });

                    //Prevent click from sorting column
                    input.on('click', function (e) {
                        e.stopPropagation();
                    });

                    // There are 2 events fired on input element when clicking on the clear button:// mousedown and mouseup.
                    input.on('mouseup', function (e) {
                        var that = this;
                        var oldValue = this.value;
                        if (oldValue === '')
                            return;
                        
                        // When this event is fired after clicking on the clear button // the value is not cleared yet. We have to wait for it.
                        setTimeout(function () {
                            var newValue = that.value;
                            if (newValue === '') {
                                table.column($(that).parent().index() + ':visible').search(newValue).draw();
                                e.preventDefault();
                            }
                        }, 1);
                    });

                    //Make nodes tabbable withtout selecting td
                    input.parent().attr('tabindex', -1);
                });
            }
        });


        $('.buttons-collection').addClass('btn-sm');

        $('.buttons-copy').removeClass('btn-secondary').addClass('btn-sm btn-warning').html('<i class="mdi mdi-content-copy"></i>').attr('title', "Copy");
        $('.buttons-csv').removeClass('btn-secondary').addClass('btn-sm btn-success').html('<i class="mdi mdi-google-spreadsheet"></i>').attr('title', "CSV");
        $('.buttons-excel').removeClass('btn-secondary').addClass('btn-sm btn-primary').html('<i class="mdi mdi-microsoft-excel"></i>').attr('title', "Excel");
        $('.buttons-pdf').removeClass('btn-secondary').addClass('btn-sm btn-dark').html('<i class="mdi mdi-file-pdf-box"></i>').attr('title', "PDF");
        $('.buttons-print').removeClass('btn-secondary').addClass('btn-sm btn-dark').html('<i class="mdi mdi-printer"></i>').attr('title', "Print");
        $('.buttons-colvis').addClass('btn-sm').html('<i class="mdi mdi-database-eye"></i>').attr('title', "Column Visibility");

        $('.dataTables_filter').find('input').attr('placeholder', 'Search Here...');

        $('.dataTables_paginate').find('.page-item').addClass('pl-0 pr-0');

        $('.datatable-serverside').parent().addClass('table-responsive');

        $('.buttons-colvis').click(function(event) {
            if($('.dt-button-collection').find('.dropdown-menu').find('.colvis-search-panel').length == 0){
                $('.dt-button-collection').find('.dropdown-menu').css('min-width', '200px');
                $('.dt-button-collection').find('.dropdown-menu').prepend('<div class="colvis-search-panel" style="width: 100%;"><div style="width: 25px;float: left;clear: right"><label style="cursor: pointer;margin-bottom: 0px"><input type="checkbox" id="check-all-columns" onclick="checkAllColumns()" style="margin-top:10px;pointer-events: none !important;margin-left: 10px"></label></div><div style="float: left;clear: right"><input type="text" placeholder="Search Columns..." style="width: 102%;margin-left: 5px" onkeyup="searchColumnVisibility($(this))" onchange="searchColumnVisibility($(this))"></div></div>');
            }

            $('.dt-button-collection').find('.buttons-columnVisibility').attr('onclick', 'updateColumnVisibility();');
            
            updateColumnVisibility(false);
        });
    });

    function reloadDatatable() {
        $('.datatable-serverside').DataTable().ajax.reload();
    }

    function serversideDataExport(e, dt, button, config) {
         var self = this;
         var oldStart = dt.settings()[0]._iDisplayStart;
         dt.one('preXhr', function (e, s, data) {
            data.start = 0;
            data.length = 2147483647;
            dt.one('preDraw', function (e, settings) {
                if (button[0].className.indexOf('buttons-copy') >= 0) {
                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-print') >= 0) {
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
                 
                 dt.one('preXhr', function (e, s, data) {
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                 });

                 if (button[0].className.indexOf('buttons-print') < 0){
                    setTimeout(dt.ajax.reload, 0);
                 }
                 return false;
             });
         });
         dt.ajax.reload();
    }

    function updateColumnVisibility(ajax_call = true) {
        var columns = [];
        $.each($('.buttons-colvis').parent().find('.buttons-columnVisibility'), function(index, val) {
            var this_option = $(this);
            var content = '<span>'+this_option.text().trim()+'</span>';
            var active = this_option.hasClass('active');
            this_option.css('padding-left', '10px');
            this_option.html('<span style="cursor: pointer;pointer-events: none !important;color: '+(active ? 'white' : 'black')+';margin-bottom: 0px"><input type="checkbox" style="margin-top:10px;pointer-events: none !important;" '+(active ? 'checked' : '')+'>&nbsp;&nbsp;'+(content)+'</span>');

            if(active){
                this_option.find('div').attr('style', 'cursor: pointer;color: white;margin-bottom: 0px');
                this_option.find('input').prop('checked', true);
            }else{
                this_option.find('div').attr('style', 'cursor: pointer;color: black;margin-bottom: 0px');
                this_option.find('input').prop('checked', false);
            }

            columns.push(active);
        });

        $.each($('.datatable-serverside thead tr th'), function(index, val) {
            $(this).find('input').attr('placeholder', $(this).attr('aria-label').split(':')[0]);
        });

        if(ajax_call){
            $.ajax({
                url: "{{ url('admin/update-user-column-visibilities') }}",
                type: 'POST',
                data: {"_token": "{{ csrf_token() }}",url: location.href, columns: columns},
            });
        }

        checkIfAllChecked();
    }

    function checkIfAllChecked() {
        var count = 0;
        var active_count = 0;
        $.each($('.buttons-columnVisibility'), function(index, val) {
            count++;
            active_count += ($(this).hasClass('active') ? 1 : 0);
        });

        if(count > 0 && count == active_count){
            $('#check-all-columns').prop('checked', true);
        }else{
            $('#check-all-columns').prop('checked', false);
        }
    }

    function checkAllColumns() {
        var active = $('#check-all-columns').is(':checked');
        if(active){
            $('.buttons-columnVisibility').addClass('active');
        }else{
            $('.buttons-columnVisibility').removeClass('active');
        }

        var indexes = [];
        $.each($('.buttons-columnVisibility'), function(index, val) {
            indexes.push(index);
        });

        var table = $('.datatable-serverside').DataTable();
        table.columns(indexes).visible(active);

        updateColumnVisibility();
    }

    function searchColumnVisibility(element) {
        var value = element.val();
        if(value!=""){
            $.each($('.buttons-columnVisibility'), function(index, val) {
                if($(this).text().toLowerCase().search(value.toLowerCase()) > 0){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            });
        }else{
            $('.buttons-columnVisibility').show();
        }
    }

    function oderDatatableColumn(index) {
        
    }

    function notification(status, message) {
        swal({
            icon: status,
            text: message,
            dangerMode: true,
            buttons: {
                cancel: false,
                confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    closeModal: true
                },
            },
        });
    }

    function deleteFromCRUD(button) {
        swal({
            title: "Are you sure ?",
            text: "Once you delete, You can not recover this data and related files.",
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: true,
                confirm: {
                    text: "Delete",
                    value: true,
                    visible: true,
                    closeModal: true
                },
            },
        }).then((value) => {
            if(value){
                $.ajax({
                    type: 'DELETE',
                    url: button.attr('data-src'),
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    dataType: 'json',
                    success:function (response) {
                        if(response.success){
                            notification('success', response.message)
                            button.parent().parent().remove();
                        }else{
                            notification('error', response.message);
                            return;
                        }
                    },
                });
            }
        });
    }
</script>
