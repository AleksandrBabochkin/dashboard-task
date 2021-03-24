DatatableHelper = {
    init: function(id, url, columns, data = null ){
        return $(id).DataTable({
            pageLength:     10,
            processing:     true,
            serverSide:     true,
            scrollX:        true,
            fixedColumns:   true,
            order: [],
            sDom: '<"top">tr<"bottom">p<"clear">',

            ajax: {
                url: url,
                data: data,
            },
            columns: columns,
            language: {
                search:         Lang.get('datatables.search'),
                lengthMenu:     Lang.get('datatables.length_menu'),
                info:           Lang.get('datatables.info'),
                infoEmpty:      "",
                infoFiltered:   "",
                infoPostFix:    "",
                loadingRecords: Lang.get('datatables.loading_records'),
                zeroRecords:    "",
                emptyTable:     "",
                paginate: {
                    first: "",
                    previous: "Назад",
                    next: "Вперед",
                    last: ""
                },
                aria: {
                    sortAscending:  Lang.get('datatables.aria.sort_ascending'),
                    sortDescending: Lang.get('datatables.aria.sort_descending'),
                }
            },
            columnDefs: [
                {
                    'targets': 0,
                    'createdCell':  function (td) {
                        $(td).addClass('without_date_color');
                    }
                },
            ]
        });
    },
    delete_method: function (url_d, token, table) {
        if (url_d && token) {
            if (confirm('Удалить элемент')) {
                if (!table) {
                    table = datatable;
                }
                if( table == 'datatableTab'){
                    table = datatableTab;
                }
                const data = {
                    _method: 'DELETE',
                    _token: token
                };

                const success = function (data) {
                    if (data['action'] && data['action'] == 'reload_table') {
                        table.ajax.reload(null, false);
                    }
                };
                this.sendRequest('POST', url_d, data, success);
            }
        }
        return true;
    },
    sendRequest: function(type, url, data, success, error = null) {
        $.ajax({
            type: type,
            url: url,
            cache: false,
            dataType: 'json',
            data: data,
            success: success,
            error: error
        });
    }
};
$(document).ready(function(){
    $('a[data-type=search]').click(function () {
        datatable.search($('input[data-type=search]').val()).draw();
    })
    $('input[data-type=search]').keyup(function (event) {
        if (event.keyCode == 13) {
            datatable.search($(this).val()).draw();
        }
    });
    $('select[id=status]').change(function (event) {
        datatable.ajax.reload( null, false );
    });
    $('select[id=type]').change(function (event) {
        datatable.ajax.reload( null, false );
    });
    $('select[id=user]').change(function (event) {
        datatable.ajax.reload( null, false );
    });
});
