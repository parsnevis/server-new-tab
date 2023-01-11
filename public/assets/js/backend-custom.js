// $(function() {$(".datepicker").persianDatepicker({'formatDate': 'YYYY-MM-DD'});});

const ADMIN_URL = '/admin';
const ADMIN_SHIPMENT_URL = ADMIN_URL + '/shipments';
const ADMIN_STAFF_URL =  ADMIN_URL + '/staffs';
const ADMIN_USER_URL =  ADMIN_URL + '/users';
const ADMIN_AGENT_URL =  ADMIN_URL + '/agents';
const ADMIN_EVENT_URL =  ADMIN_URL + '/events';
const ADMIN_COUNTRY_URL =  ADMIN_URL + '/countries';
const ADMIN_SETTING_URL =  ADMIN_URL + '/settings';
const ADMIN_ROLE_URL =  ADMIN_URL + '/roles';
const ADMIN_PERMISSION_URL =  ADMIN_URL + '/permissions';

var _options = {
    "pageLength": 15,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "همه"]],
    "processing": true,
    'paginate': true,
    ordering: true,
    stateSave: true,
    pagingType: 'full_numbers',
    // scrollX: true,
    // "responsive": true,
    // "autoWidth": false,
    // "order": [0, 'DESC'],
    // "order": [0, 'ASC'],
    // "order": [0, 1],
    // "language": {
    //     "lengthMenu": "Display _MENU_ records per page",
    //     "zeroRecords": "Nothing found - sorry",
    //     "info": "Showing page _PAGE_ of _PAGES_",
    //     "infoEmpty": "No records available",
    //     "infoFiltered": "(filtered from _MAX_ total records)"
    // },
    // search: {
    //     return: true,
    // },
    "language": {
        "lengthMenu": "نمایش _MENU_ رکورد در هر صفحه",
        "zeroRecords": "متاسفانه هیچ رکوردی پیدا نشد.",
        "info": "نمایش صفحه _PAGE_ از _PAGES_ صفحه",
        "infoEmpty": "هیچ رکوردی موجود نیست",
        "infoFiltered": "(فیلتر شده از مجموع _MAX_ رکورد)",
        "search": "جستجو : ",
        "paginate": {
            "previous": "قبلی",
            "next": "بعدی",
            "first": "ابتدا",
            "last": "انتها",
        }
    },
    "dom": "<'row'><'row'<'col-md-6'l><'col-md-6'f>>t<'row'<'col-md-4'i>><'row'p>"
};

var default_laguage = $('input[name=default_laguage]').val();
// console.log(default_laguage)
var _datePickerOption = {
    format: 'YYYY/MM/DD',
    autoClose: true,
    observer: true,

    calendar:{
        persian: {
            // locale: default_laguage == 'fa' ? 'fa' : 'en',
            locale: 'en',
        }
    },
    // inline: true,
    // altField: '#gregorianExampleAlt',
    // altFormat: 'LLLL',
    calendarType: default_laguage == 'fa' ? 'persian' : 'gregorian',
    toolbox:{
        calendarSwitch:{
            enabled: false
        }
    },
    navigator:{
        scroll:{
            enabled: true
        }
    },
    // maxDate: new persianDate().add('month', 3).valueOf(),
    // minDate: new persianDate().subtract('month', 3).valueOf(),
    // timePicker: {
    //     enabled: true,
    //     meridiem: {
    //         enabled: true
    //     }
    // }
};

var _dateTimePickerOption = {
    format: 'YYYY/MM/DD H:m:s',
    // autoClose: true,
    // onlyTimePicker: true,
    observer: true,
    calendar:{
        persian: {
            // locale: default_laguage == 'fa' ? 'fa' : 'en',
            locale: 'en',
        }
    },
    calendarType: default_laguage == 'fa' ? 'persian' : 'gregorian',
    toolbox:{
        calendarSwitch:{
            enabled: false
        }
    },
    navigator:{
        scroll:{
            enabled: true
        }
    },
    timePicker: {
        enabled: true,
        meridiem: {
            enabled: true
        }
    }
};

function currency(currency_type, currency_rate, currency_price)
{
    // var currency_id = $('#payments select[name=payments_currency_id] option:selected').val();
    // var currency_rate = $('#payments input[name=payments_currency_rate]').val();
    // var currency_price = $('#payments input[name=payments_currency_price]').val();

    if(currency_type == 1)
    {
        // $('#payments input[name=payments_currency_rate]').prop('disabled', true);
        // $('#payments input[name=payments_amount]').val(currency_price);
        // $('#payments input[name=payments_amount_alt]').val(currency_price);
        amount = currency_price;
    }
    else
    {
        // $('#payments input[name=payments_currency_rate]').prop('disabled', false);
        if(currency_rate != 0)
        {
            // $('#payments input[name=payments_amount]').val(currency_rate*currency_price);
            // $('#payments input[name=payments_amount_alt]').val(currency_rate*currency_price);
            amount = currency_rate*currency_price;
        }
        else
        {
            // $('#payments input[name=payments_amount]').val(currency_price);
            // $('#payments input[name=payments_amount_alt]').val(currency_price);
            amount = currency_price;
        }

    }


    return amount;
}

let _DataTable;
function dataTableC(status) {

    let url = $('input#url').val();
    // let status = $(this).data('id').split('-').join(' ');
    $('input#status').val(status);

    if(typeof _DataTable != "undefined")
        _DataTable.destroy();

    _options.serverSide = true;
    _options.ajax = status ? (url + '?status=' + status) : url;

    _options.columns = [
        // {data: 'DT_RowIndex', name: 'DT_RowIndex', width: 'auto'},
        {data: 'DT_RowIndex', name: 'id', width: '30px'},
        {data: 'shipment_number', name: 'shipment_number', width: '75px', orderable: true, searchable: true},
        {data: 'marketer', name: 'marketer', width: '100px', orderable: true, searchable: true},
        {data: 'customer', name: 'customer', width: '100px', orderable: true, searchable: true},
        {data: 'startDate/deadLine', name: 'startDate/deadLine', width: '80px', orderable: true, searchable: true},
        {data: 'origin/destination', name: 'origin/destination', width: '100px', orderable: true, searchable: true},
        {data: 'weight', name: 'weight', width: '40px', orderable: true, searchable: true},
        {data: 'status', name: 'status', width: '60px', orderable: true, searchable: true},
        {data: 'ref_no', name: 'ref_no', width: '90px', orderable: true, searchable: true},
        // {data: 'operations', name: 'operations', width: '10%'},

        {data: 'operations', name: 'operations', width: 'auto', orderable: false, searchable: false},
    ];
    _DataTable = $('table.data-table').DataTable(_options);


    // let url = $('input#url').val();
    // let status = $(this).data('id').split('-').join(' ');
    // $('input#status').val(status);
    //
    // _DataTable.destroy();
    // _options.serverSide = true;
    // _options.ajax = url + '?status=' + status;
    // _options.columns = [
    //     // {data: 'DT_RowIndex', name: 'DT_RowIndex', width: 'auto'},
    //     {data: 'DT_RowIndex', name: 'id', width: 'auto'},
    //     {data: 'shipment_number', name: 'shipment_number', width: '8%', orderable: true, searchable: true},
    //     {data: 'marketer', name: 'marketer', width: '8%', orderable: true, searchable: true},
    //     {data: 'customer', name: 'customer', width: '8%', orderable: true, searchable: true},
    //     {data: 'startDate/deadLine', name: 'startDate/deadLine', width: '8%', orderable: true, searchable: true},
    //     {data: 'origin/destination', name: 'origin/destination', width: '8%', orderable: true, searchable: true},
    //     {data: 'weight', name: 'weight', width: '6%', orderable: true, searchable: true},
    //     {data: 'status', name: 'status', width: '8%', orderable: true, searchable: true},
    //     {data: 'ref_no', name: 'ref_no', width: '8%', orderable: true, searchable: true},
    //     // {data: 'operations', name: 'operations', width: '10%'},
    //     {data: 'operations', name: 'operations', width: '10%', orderable: false, searchable: false},
    // ];
    // _DataTable = $('table.data-table').DataTable(_options);

}

$(document).ready(function ($) {
    // $('table[data-table=data-table-1]').DataTable({
    //     "processing": true,
    //     "serverSide": true,
    //     "ajax": "{{ route('api.countries.index') }}",
    //     // "deferLoading": 57,
    //     columns: [
    //         {"data": "name_en"},
    //         {"data": "name_fa"},
    //         {"data": "iso2"}
    //     ]
    // });

    // $('table[data-table=data-table]').DataTable(_options);
    // $('table.data-table').DataTable(_options);


    $('.selectpicker').select2({
        theme: 'bootstrap4'
    });

    // $(".datepicker").pDatepicker({
    //     format: 'YYYY/MM/DD',
    //     autoClose: true
    // });


    $('.date_picker').persianDatepicker(_datePickerOption);
    $('.date_time_picker').persianDatepicker(_dateTimePickerOption);

    $('[data-toggle="tooltip"]').tooltip();
    dataTableC();

    /* ############################################### */
    /* ###################  Customer  ################## */

    $(document).on('change', 'input[name=customer_status]', function () {
        var id = $(this).attr('id').split('-')[1];
        var activated = $(this).prop('checked') == true ? 'Yes' : 'No';

        $('#message').removeClass('notice-success');
        $('#message').removeClass('notice-error');

        let _url     = `/users/`+id;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let _method   = 'PUT';

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: id,
                ajax_activated: 1,
                activated: activated,
                _method: _method,
                _token: _token
            },
            success: function(response) {
                if(response.code == 200) {
                    if(id != ""){
                        $('#message').addClass('notice-'+response.result_type);
                        $('#message p').html(response.result_message);
                        $('#message').slideDown().delay(3000).slideUp();
                    } else {
                    }
                }
            },
            error: function(response) {
                // $('#titleError').text(response.responseJSON.errors.title);
                // $('#descriptionError').text(response.responseJSON.errors.description);

                // $('#message').addClass('notice-error');
                // $('#message p').html('متاسفانه عملیات با موفقیت انجام نشد.');
                // $('#message').slideDown().delay(3000).slideUp();
            }
        });
    });

    /* ###################  Customer  ################## */
    /* ############################################### */



    /* ############################################### */
    /* ###################  Agents  ################## */

    $(document).on('change', 'input[name=agent_activated], input[name=agent_pickup_status],' +
        'input[name=agent_forward_status], input[name=agent_clearance_status], input[name=agent_deliver_status]', function () {
        var id = $(this).attr('id').split('-')[1];

        var pickup = $(this).parent().parent().parent().find('input[name=agent_pickup_status]').prop('checked');
        var forward = $(this).parent().parent().parent().find('input[name=agent_forward_status]').prop('checked');
        var clearance = $(this).parent().parent().parent().find('input[name=agent_clearance_status]').prop('checked');
        var deliver = $(this).parent().parent().parent().find('input[name=agent_deliver_status]').prop('checked');
        var activated = $(this).parent().parent().parent().find('input[name=agent_activated]').prop('checked');

        // var forward = $('input[name=agent_forward_status]').prop('checked');
        // var clearance = $('input[name=agent_clearance_status]').prop('checked');
        // var deliver = $('input[name=agent_deliver_status]').prop('checked');
        // var activated = $('input[name=agent_activated]').prop('checked');

        if($(this).attr('name') == 'agent_pickup_status')
            pickup = $(this).prop('checked');
        if($(this).attr('name') == 'agent_forward_status')
            forward = $(this).prop('checked');
        if($(this).attr('name') == 'agent_clearance_status')
            clearance = $(this).prop('checked');
        if($(this).attr('name') == 'agent_deliver_status')
            deliver = $(this).prop('checked');
        if($(this).attr('name') == 'agent_activated')
            activated = $(this).prop('checked');

        console.log(pickup);
        console.log(forward);
        console.log(clearance);
        console.log(deliver);
        console.log(activated);

        $('#message').removeClass('notice-success');
        $('#message').removeClass('notice-error');

        let _url     = `/agents/`+id;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let _method   = 'PUT';

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: id,
                ajax_activated: 1,
                pickup: pickup,
                forward: forward,
                clearance: clearance,
                deliver: deliver,
                activated: activated,
                _method: _method,
                _token: _token
            },
            success: function(response) {
                if(response.code == 200) {
                    if(id != ""){
                        $('#message').addClass('notice-'+response.result_type);
                        $('#message p').html(response.result_message);
                        $('#message').slideDown().delay(3000).slideUp();
                    } else {
                    }
                }
            },
            error: function(response) {
                // $('#titleError').text(response.responseJSON.errors.title);
                // $('#descriptionError').text(response.responseJSON.errors.description);

                // $('#message').addClass('notice-error');
                // $('#message p').html('متاسفانه عملیات با موفقیت انجام نشد.');
                // $('#message').slideDown().delay(3000).slideUp();
            }
        });

    });

    /* ###################  Agents  ################## */
    /* ############################################### */



    /* ############################################### */
    /* #################  Shipments  ################# */

    /* ############  list  Shipments  ############ */
    $(document).on('click', '.shipment-status', function () {
        var id = $(this).data('id');

        let _url     = `/shipments/`+id+'/status';
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let _method   = 'GET';

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                _method: _method,
                _token: _token,
                id: id,
            },
            success: function(response) {
                $('#modal-shipment-status .modal-body').html(response);
            },
            error: function(response) {
            }
        });

        $('#modal-shipment-status .modal-body input[name=shipment_id]').val(id);
        $('#modal-shipment-status').modal('show');
    });

    $(document).on('click', 'button.update_status_shipment', function (e) {
        e.preventDefault();
        var id = $('#update_status_shipment input[name=shipment_id]').val();
        let _url     = `/shipments/`+id+'/status';

        $('form#update_status_shipment').attr('action', _url);
        $('form#update_status_shipment').submit();
    });


    // $(document).on('click', '.shipment-event', function () {
    //     var id = $(this).data('id');
    //
    //     let _url     = `/shipments/`+id+'/shipment';
    //     let _token   = $('meta[name="csrf-token"]').attr('content');
    //
    //     $.ajax({
    //         url: _url,
    //         type: "POST",
    //         data: {
    //             id: id,
    //             ajax_activated: 1,
    //             _token: _token
    //         },
    //         success: function(response) {
    //             if(response) {
    //                 var events = response.events;
    //                 var shipment_events = response.shipment_events;
    //
    //                 $.each(events, function (index, event) {
    //                     $('select[name=event_id]').append('<option value="'+event.id+'">' + event.name_fa + ' (' + event.code + ')' + '</option>');
    //                 });
    //
    //                 table = $('.shipment_events table').DataTable();
    //                 table.destroy();
    //                 $('.shipment_events table tbody').html('');
    //                 if(shipment_events.length > 0)
    //                 {
    //                     $.each(shipment_events, function (index, shipment_event) {
    //                         console.log(shipment_event)
    //                         console.log(shipment_event.event)
    //
    //                         var checked = shipment_event.activated == 'Yes' ? 'checked' : '';
    //                         $('.shipment_events table tbody').append('<tr>' +
    //                             '<td>'+(index+1)+'</td>' +
    //                             '<td>'+shipment_event.description+'</td>' +
    //                             '<td>'+shipment_event.date+'</td>' +
    //                             '<td>'+shipment_event.location+'</td>' +
    //                             '<td>' +
    //                             '<div class="onoffswitch">' +
    //                             '<input type="checkbox" name="activated" class="onoffswitch-checkbox" id="shipment_enevt-'+shipment_event.id+'" '+ checked +'>' +
    //                             '<label class="onoffswitch-label" for="shipment_enevt-'+shipment_event.id+'"></label>' +
    //                             '</div>' +
    //                             '</td></tr>');
    //                     });
    //                 }
    //                 $('.shipment_events table').attr('data-table','data-table');
    //                 $('.shipment_events table[data-table=data-table]').DataTable(_options);
    //             }
    //         }
    //     });
    //
    //     $('#modal-shipment-event .modal-body input[name=shipment_id]').val(id);
    //     $('#modal-shipment-event').modal('show');
    // });

    // $(document).on('click', '.shipment-event', function () {
    //     var id = $(this).data('id');
    //
    //     let _url     = `/shipments/`+id+'/event';
    //     let _token   = $('meta[name="csrf-token"]').attr('content');
    //     let _method   = 'GET';
    //
    //     $.ajax({
    //         url: _url,
    //         type: "POST",
    //         data: {
    //             _method: _method,
    //             _token: _token,
    //             id: id,
    //             ajax_activated: 1
    //         },
    //         success: function(response) {
    //             $('#modal-shipment-event .modal-body').html(response);
    //             $('.datepicker').persianDatepicker(_datepickerOption);
    //         },
    //         error: function(response) {
    //         }
    //     });
    //
    //     $('#modal-shipment-event .modal-body input[name=shipment_id]').val(id);
    //     $('#modal-shipment-event').modal('show');
    // });

    // $(document).on('click', '#insert_shipment_event .insert_shipment_event', function (e) {
    //     e.preventDefault();
    //     var id = $('#insert_shipment_event input[name=shipment_id]').val();
    //     let _url     = `/shipments/`+id+'/event';
    //
    //     $('form#insert_shipment_event').attr('action', _url);
    //     $('form#insert_shipment_event').submit();
    // });


    $(document).on('change', '.shipment_events table input[name=activated]', function () {
        var id = $(this).attr('id').split('-')[1];
        var activated = $(this).prop('checked') == true ? 'Yes' : 'No';

        // $('#message').removeClass('notice-success');
        // $('#message').removeClass('notice-error');

        let _url     = `/shipment_events/`+id;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let _method   = 'PUT';

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: id,
                ajax_activated: 1,
                activated: activated,
                _method: _method,
                _token: _token
            },
            success: function(response) {
                console.log(response);
                // if(response.code == 200) {
                //     if(id != ""){
                //         $('#message').addClass('notice-'+response.result_type);
                //         $('#message p').html(response.result_message);
                //         $('#message').slideDown().delay(3000).slideUp();
                //     }
                //     else {
                //     }
                // }
            },
            error: function(response) {
            }
        });
    });


    $(document).on('keyup', 'input#search', function () {
        let data_table_type = $('input#data-table-type').val();
        let _url = '/'+ data_table_type +'/fetch_data';
        let search = $(this).val();
        // let status = $(this).attr('id').split('-')[0];
        let status = $('input#status').val();
        let role = $('input#role').val();
        let user_id = $('input#auth_id').val();
        let import_export = $('input#import_export').val();

        if(data_table_type == 'shipments')
            fetch_data(_url, user_id, null, import_export, status, search);
        else if(data_table_type == 'users')
            fetch_data(_url, user_id, null,null, role, search);
    });

    // $(document).on('click', '.status-box', function () {
    //     let data_table_type = $('input#data-table-type').val();
    //     // let _url = '/admin/'+ data_table_type +'/fetch_data';
    //     let _url = '/admin/'+ data_table_type;
    //     // let search = '';
    //     let status = $(this).attr('id').split('-')[0];
    //     $('input#status').val(status);
    //     // let status = $('input#status').val();
    //     let role = $('input#role').val();
    //     let user_id = $('input#auth_id').val();
    //     let import_export = $('input#import_export').val();
    //
    //
    //     if(data_table_type == 'shipments')
    //         fetch_data(_url, user_id, null, import_export, status, null);
    //     // else if(data_table_type == 'users')
    //     //     fetch_data(_url, user_id, null, role, null);
    // });

    $(document).on('click', '.status-box', function () {

        let selected = $(this);
        let url = $('input#url').val();
        // let _url = '/admin/'+ data_table_type +'/fetch_data';
        // let _url = '/'+ url;
        // let search = '';
        // let status = $(this).attr('id').split('-')[0];
        let types = $(this).data('id');
        let status = types.split('-').join(' ');
        $('input#status').val(status);
        // let status = $('input#status').val();
        // let role = $('input#role').val();
        // let user_id = $('input#auth_id').val();
        // let import_export = $('input#import_export').val();


        let _token   = $('meta[name="csrf-token"]').attr('content');
        let _method   = 'POST';
        $.ajax({
            queue: true,
            url: '/admin/shipments/show_button',
            type: "POST",
            method: "POST",
            data: {
                _method: _method,
                _token: _token,
                status: status,
            },
            success: function(response) {
                console.log(selected);
                $('.show_button').html(response);


                $('.status-box').removeClass('active');
                $(selected).addClass('active');
                $('.select-status').html('');
                $(selected).find('.select-status').html('<i class="fas fa-chevron-up text-info"></i>');
                // $('#'+types+'-status .select-status').html('<i class="fas fa-chevron-up text-info"></i>');
            },
            error: function(error) {
            }
        });





        dataTableC(status);
    });

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        let data_table_type = $('input#data-table-type').val();
        let _url = '/admin/'+ data_table_type +'/fetch_data';
        let page_number = $(this).attr('href').split('page=')[1];
        let status = $('input#status').val();
        let import_export = $('input#import_export').val();
        let role = $('input#role').val();
        let user_id = $('input#auth_id').val();

        if(data_table_type == 'shipments')
            fetch_data(_url, user_id, page_number, import_export, status, null);
        else if(data_table_type == 'users')
            fetch_data(_url, user_id, page_number, import_export, role, null);
    });

    function fetch_data(url, user_id, page_number = null, import_export, types, search = null) {
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let _method   = 'GET';

        $.ajax({
            queue: true,
            url: url,
            type: "GET",
            data: {
                _method: _method,
                _token: _token,
                user_id: user_id,
                page: page_number,
                import_export: import_export,
                types: types,
                search: search
            },
            success: function(response) {
                $('#data_table').html(response);

                $('.select-status').html('');
                $('#'+types+'-status .select-status').html('<i class="fas fa-chevron-up text-info"></i>');
            },
            error: function(response) {
            }
        });
    }

    // $(document).on('click', '.select-information-sender, .select-information-receiver', function () {
    //
    //     let selected = $(this).attr('class').split('-')[2];
    //     let customer_id = $('#customer_id option:selected').val();
    //
    //     console.log(customer_id)
    //     if(customer_id)
    //     {
    //         let _token   = $('meta[name="csrf-token"]').attr('content');
    //         let _url = '/users/find_user';
    //         let _method   = 'POST';
    //
    //         $.ajax({
    //             // queue: true,
    //             url: _url,
    //             type: "POST",
    //             data: {
    //                 _method: _method,
    //                 _token: _token,
    //                 user_id: customer_id,
    //                 // page: page_number,
    //                 // import_export: import_export,
    //                 // types: types,
    //                 // search: search
    //             },
    //             success: function(response) {
    //                 console.log(response)
    //                 $('#'+selected+'_name').val(response.first_name + ' ' + response.last_name);
    //                 $('#'+selected+'_country').val(response.shipping_country);
    //                 $('#'+selected+'_country').trigger('change');
    //                 $('#'+selected+'_email').val(response.email);
    //                 $('#'+selected+'_phone').val(response.phone);
    //                 $('#'+selected+'_mobile').val(response.mobile);
    //                 // $('#'+selected+'_fax').val(response.fax);
    //                 $('#'+selected+'_zip_code').val(response.shipping_zip_code);
    //                 $('#'+selected+'_address').val(response.shipping_address);
    //
    //
    //                 // $('select[name='+selected+'_county]').select2("destroy");
    //                 // $('select[name='+selected+'_county]').html('');
    //             },
    //             error: function(response) {
    //             }
    //         });
    //     }
    // });

    $(document).on('change', '.shipment_information #customer_id', function () {

        // let selected = $(this).attr('class').split('-')[2];
        // let customer_id = $('#customer_id option:selected').val();
        let selected = $(this);
        let customer_id = $(this).val();

        console.log(customer_id)
        if(customer_id)
        {
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let _url = ADMIN_USER_URL + '/find_user_address';
            let _method   = 'POST';

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    _method: _method,
                    _token: _token,
                    user_id: customer_id,
                },
                success: function(response) {
                    console.log(response)
                    $('#sender_address_id').html('<option value=""></option>');
                    $('#receiver_address_id').html('<option value=""></option>');
                    let addresses = response.addresses
                    $.each(addresses, function () {
                        console.log(this)
                        $('#sender_address_id').append('<option value="'+this.id+'">'+ (this.first_name + ' ' + this.last_name) +'</option>');
                        $('#receiver_address_id').append('<option value="'+this.id+'">'+ (this.first_name + ' ' + this.last_name) +'</option>');
                    });

                },
                error: function(error) {
                }
            });
        }
    });

    $(document).on('change', '.shipment_information #sender_address_id, .shipment_information #receiver_address_id', function () {

        let selected = $(this).attr('id').split('_')[0];
        let address_id = $(this).val();
        let customer_id = $('.shipment_information #customer_id').val();

        if(address_id)
        {
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let _url = ADMIN_USER_URL + '/find_user_address_details';
            let _method   = 'POST';

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    _method: _method,
                    _token: _token,
                    user_id: customer_id,
                    address_id: address_id,
                },
                success: function(response) {
                    console.log(response)
                    let address = response.address;
                    $('#'+selected+'_name').val(address.first_name + ' ' + address.last_name);
                    $('#'+selected+'_country').val(address.shipping_country);
                    $('#'+selected+'_country').trigger('change');
                    $('#'+selected+'_email').val(address.email);
                    $('#'+selected+'_phone').val(address.phone);
                    $('#'+selected+'_mobile').val(address.mobile);
                    // $('#'+selected+'_fax').val(address.fax);
                    $('#'+selected+'_zip_code').val(address.shipping_zip_code);
                    $('#'+selected+'_address').val(address.shipping_address);
                },
                error: function(error) {
                }
            });
        }
    });





    /* ############  Edit  Shipments  ############ */
    $(document).on('click', '.add_row', function (){
        $('.cost-items-table tbody tr:last td.select select').select2("destroy");
        $('.cost-items-table tbody tr:last').clone().appendTo($('.cost-items-table tbody'));
        $('.selectpicker').select2({theme: 'bootstrap4'});
        $('.cost-items-table tbody tr:last td.select select').val("").trigger("change");
        $('.cost-items-table tbody tr:last td:not(".select") *').val("");

        $('.cost-items-table tbody tr:last input[name="cost_deleted[]"]').val(0);
        $('.cost-items-table tbody tr:last input[name="cost_id[]"]').val(0);
        $('.cost-items-table tbody tr:last input[name="cost_item_id[]"]').val(0);
    });

    $(document).on('change', '#item_select', function () {
        var selected = $('#item_select option:selected');
        // var title = selected.text();
        var item_id = selected.val();
        // var description = selected.attr('data-subtext');
        // var item_type = selected.attr('data-item_type');

        var name = selected.attr('data-name');
        var alt_name = selected.attr('data-alt-name');

        // console.log(item_type);

        $('.cost-items-table tbody tr:last textarea[name="title[]"]').val(alt_name + ' (' + name + ')');
        // $('.cost-items-table tbody tr:last textarea[name=description\\[\\]]').val(description);
        $('.cost-items-table tbody tr:last input[name="cost_item_id[]"]').val(item_id);
        // $('.cost-items-table tbody tr:last input[name=item_type]').val(item_type);
    });

    $(document).on('click', '.delete-cost', function () {
        // table = $('table.cost-items-table').DataTable();
        // table.destroy();


        // if($('.invoice-items-table tbody tr').length > 1)
            $(this).parent().parent().parent().parent().find('input[name=cost_deleted\\[\\]]').val(1);
        $(this).parent().parent().parent().parent().hide();
        // $(this).parent().parent().css('background-color', 'red');
        // $(this).html('undo');

        // $('table[data-table=data-table]').DataTable(_options);
    });

    $(document).on('change', '#payments select[name=payments_currency_id], #payments input[name=payments_currency_rate], #payments input[name=payments_currency_price]', function () {
        var currency_id = $('#payments select[name=payments_currency_id] option:selected').val();
        var currency_rate = $('#payments input[name=payments_currency_rate]').val();
        var currency_price = $('#payments input[name=payments_currency_price]').val();

        if(currency_id == 1)
        {
            $('#payments input[name=payments_currency_rate]').prop('disabled', true);
            $('#payments input[name=payments_amount]').val(currency_price);
            $('#payments input[name=payments_amount_alt]').val(currency_price);
        }
        else
        {
            $('#payments input[name=payments_currency_rate]').prop('disabled', false);
            if(currency_rate != 0)
            {
                $('#payments input[name=payments_amount]').val(currency_rate*currency_price);
                $('#payments input[name=payments_amount_alt]').val(currency_rate*currency_price);
            }
            else
            {
                $('#payments input[name=payments_amount]').val(currency_price);
                $('#payments input[name=payments_amount_alt]').val(currency_price);
            }

        }
    });

    $(document).on('change', 'input[name=pallet_checked], input[name=carton_checked], input[name=bag_checked]', function () {
        var selected = $(this).attr('name').split('_')[0];
        // console.log($(this).prop('checked'));
        if($(this).prop('checked'))
        {
            $('.add-'+selected).prop('disabled', false);
            $('input[name='+selected+'_length\\[\\]]').prop('disabled', false);
            $('input[name='+selected+'_width\\[\\]]').prop('disabled', false);
            $('input[name='+selected+'_height\\[\\]]').prop('disabled', false);
            $('button.delete-'+selected).prop('disabled', false);
        }
        else
        {
            $('.add-'+selected).prop('disabled', true);
            $('input[name='+selected+'_length\\[\\]]').prop('disabled', true);
            $('input[name='+selected+'_width\\[\\]]').prop('disabled', true);
            $('input[name='+selected+'_height\\[\\]]').prop('disabled', true);
            $('button.delete-'+selected).prop('disabled', true);
        }

    });

    $(document).on('click', '.add-pallet, .add-carton, .add-bag', function () {
        var selected = $(this).data('name');
        $('.'+selected+'-box .row:last').clone().appendTo($('.'+selected+'-box'));
        $('.'+selected+'-box .row:last').find('input[name=deleted\\[\\]]').remove();
        $('.'+selected+'-box .row:last').find('input').val('');
        $('.'+selected+'-box .row:last').show();
    });

    $(document).on('click', '.delete-pallet, .delete-carton, .delete-bag', function () {
        var selected = $(this).data('name');
        $(this).parent().parent().parent().parent().find('input[name='+selected+'_deleted\\[\\]]').val(1);
        $(this).parent().parent().parent().parent().hide();
    });

    $(document).on('change', 'input[name=inter_domest]', function (e) {
        var val = $(e.target).val();
        switch (val)
        {
            case 'international':
                $('.domestic_box').addClass('d-none');
                // $('#receiver_country').prop('disabled', false);
                // $('#sender_country').prop('disabled', false);
                break;

            case 'domestic':
                $('.domestic_box').removeClass('d-none');
                $('#receiver_country').val('93').change();
                $('#sender_country').val('93').change();
                // $('#receiver_country').prop('disabled', true);
                // $('#sender_country').prop('disabled', true);
                break;
        }
    });

    $(document).on('change', 'select[name=sender_province], select[name=receiver_province]', function () {
        var selected = $(this).attr('name').split('_')[0];
        var province = $('select[name='+selected+'_province] option:selected').val();

        let _url     = `/county_of_province`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: province,
                _token: _token
            },
            success: function(response) {
                var counties = response.counties;
                var sections = response.sections;
                var cities = response.cities;

                $('select[name='+selected+'_county]').select2("destroy");
                $('select[name='+selected+'_county]').html('');
                $.each(counties, function (index, county) {
                    $('select[name='+selected+'_county]').append('<option value="'+ county.id +'">'+ county.name_fa +'</option>');
                });
                $('select[name='+selected+'_county]').select2({theme: 'bootstrap4'});


                $('select[name='+selected+'_section]').select2("destroy");
                $('select[name='+selected+'_section]').html('');
                $.each(sections, function (index, section) {
                    $('select[name='+selected+'_section]').append('<option value="'+ section.id +'">'+ section.name_fa +'</option>');
                });
                $('select[name='+selected+'_section]').select2({theme: 'bootstrap4'});


                $('select[name='+selected+'_city]').select2("destroy");
                $('select[name='+selected+'_city]').html('');
                $.each(cities, function (index, city) {
                    $('select[name='+selected+'_city]').append('<option value="'+ city.id +'">'+ city.name_fa +'</option>');
                });
                $('select[name='+selected+'_city]').select2({theme: 'bootstrap4'});

            },
            error: function(response) {
            }
        });
    });

    $(document).on('change', 'select[name=sender_county], select[name=receiver_county]', function () {
        var selected = $(this).attr('name').split('_')[0];
        var county = $('select[name='+selected+'_county] option:selected').val();

        let _url     = `/section_of_county`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: county,
                _token: _token
            },
            success: function(response) {

                $('select[name='+selected+'_section]').select2("destroy");
                $('select[name='+selected+'_section]').html('');
                $.each(response, function (index, section) {
                    $('select[name='+selected+'_section]').append('<option value="'+ section.id +'">'+ section.name_fa +'</option>');
                });
                $('select[name='+selected+'_section]').select2({theme: 'bootstrap4'});
            },
            error: function(response) {
            }
        });
    });

    $(document).on('change', 'select[name=sender_section], select[name=receiver_section]', function () {
        var selected = $(this).attr('name').split('_')[0];
        var section = $('select[name='+selected+'_section] option:selected').val();

        let _url     = `/city_of_section`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: section,
                _token: _token
            },
            success: function(response) {
                $('select[name='+selected+'_city]').select2("destroy");
                $('select[name='+selected+'_city]').html('');
                $.each(response, function (index, city) {
                    $('select[name='+selected+'_city]').append('<option value="'+ city.id +'">'+ city.name_fa +'</option>');
                });
                $('select[name='+selected+'_city]').select2({theme: 'bootstrap4'});
            },
            error: function(response) {
            }
        });
    });

    $(document).on('click', '.submit_shipment', function (e) {
        // e.preventDefault();
        // $('#receiver_country').prop('disabled', false);
        // $('#sender_country').prop('disabled', false);
        //
        //
        // $('.shipment_information form').submit();
    });


    $(document).on('change', '.shipping_costs select[name="currency_id[]"], .shipping_costs input[name="currency_rate[]"], .shipping_costs input[name="currency_price[]"]', function (e) {
        let selected = $(e.target).parent().parent();

        var currency_id = selected.find('select[name="currency_id[]"] option:selected').val();
        var currency_rate = selected.find('input[name="currency_rate[]"]').val();
        var currency_price = selected.find('input[name="currency_price[]"]').val();

        let amount = currency(currency_id, currency_rate, currency_price);

        selected.find('input[name="currency_rate_alt[]"]').val(currency_rate);
        if(currency_id == 1)
        {
            selected.find('input[name="currency_rate[]"]').prop('disabled', true);
            selected.find('input[name="amount[]"]').val(amount);
            selected.find('input[name="amount_alt[]"]').val(amount);
        }
        else
        {
            selected.find('input[name="currency_rate[]"]').prop('disabled', false);
            selected.find('input[name="currency_rate[]"]').attr('required', 'required');
            if(currency_rate != 0)
            {
                selected.find('input[name="amount[]"]').val(amount);
                selected.find('input[name="amount_alt[]"]').val(amount);
            }
            else
            {
                selected.find('input[name="amount[]"]').val(amount);
                selected.find('input[name="amount_alt[]"]').val(amount);
            }

        }
    });


    $(document).on('change', '#create-mawb #shipment-all', function (e) {
        let selected = $(this);

        if(selected.prop('checked'))
        {
            $('#unselected-mawb input[name="id[]"]').prop("checked", true);
            $('#unselected-mawb input[name="id[]"]').parent().parent().appendTo("#selected-mawb");
        }
        else
        {
            $('#selected-mawb input[name="id[]"]').prop("checked", false);
            $('#selected-mawb input[name="id[]"]').parent().parent().appendTo("#unselected-mawb");
        }
    });

    $(document).on('change', '#selected-mawb input[name="id[]"], #unselected-mawb input[name="id[]"]', function (e) {
        var selected = $(this);
        if(selected.prop('checked'))
            selected.parent().parent().appendTo("#selected-mawb");
        else
            selected.parent().parent().appendTo("#unselected-mawb");
    });

    $(document).on('click', '.store-mawb', function (e) {
        if($('#selected-mawb').children().length != 0)
            $('.store-mawb-submit').click();
    });



    $(document).on('change', '#receive-mawb #shipment-all', function (e) {
        let selected = $(this);

        let receive_type = $('#receive_type').val();
        if(receive_type != "")
        {
            let received = receive_type == "received" ? "mawb-received" : "mawb-fraction";
            if(selected.prop('checked'))
            {
                $('.unselected-shipment input[name="id[]"]').prop("checked", true);
                $('.unselected-shipment input[name="id[]"]').parent().parent().appendTo(".selected-shipment." + received);
            }
            else
            {
                $('.selected-shipment input[name="id[]"]').prop("checked", false);
                $('.selected-shipment input[name="id[]"]').parent().parent().appendTo(".unselected-shipment");
            }

            // let receive_type_false = [];
            // $('.mawb-fraction input[name="id[]"]').each(function (index, value){
            //
            //     receive_type_false[index] = $('.mawb-fraction .select-item:nth-child('+(index+1)+') input[name="id[]"]').val();
            // });
            // $('#receive_type_false').val(receive_type_false.join(','));


            let mawb_fraction = [];
            $('.mawb-fraction input[name="id[]"]').each(function (index, value){

                mawb_fraction[index] = $('.mawb-fraction .select-item:nth-child('+(index+1)+') input[name="id[]"]').val();
            });
            $('#mawb_fraction').val(mawb_fraction.join(','));
        }
        else
        {
            toastr.error('لطفا نوع دریافت را انتخاب نمایید.');
            selected.prop("checked", false);
        }


    });

    $(document).on('change', '.selected-shipment input[name="id[]"], .unselected-shipment input[name="id[]"]', function (e) {
        var selected = $(this);

        let receive_type = $('#receive_type').val();
        if(receive_type != "")
        {
            let received = receive_type == "received" ? "mawb-received" : "mawb-fraction";

            if(selected.prop('checked'))
                selected.parent().parent().appendTo(".selected-shipment." + received);
            else
                selected.parent().parent().appendTo(".unselected-shipment");


            let mawb_fraction = [];
            $('.mawb-fraction input[name="id[]"]').each(function (index, value){

                mawb_fraction[index] = $('.mawb-fraction .select-item:nth-child('+(index+1)+') input[name="id[]"]').val();
            });
            $('#mawb_fraction').val(mawb_fraction.join(','));

        }
        else
        {
            toastr.error('لطفا نوع دریافت را انتخاب نمایید.');
            selected.prop("checked", false);
        }
    });


    $(document).on('change', '#receive-mawb #mawb_id', function (){
        let mawb_id = $(this).val();
        let _url     = `/admin/shipments/ShipmentsByMAWB`;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let _method   = 'POST';

        $('#receive-mawb .unselected-shipment').children().remove();
        $.ajax({
            url: _url,
            type: "POST",
            data: {
                mawb_id: mawb_id,
                _method: _method,
                _token: _token
            },
            success: function(response) {

                $.each(response, function (index, shipment){
                    // $('#receive-mawb .unselected-shipment').append('<li class="select-item" style="">\n' +
                    //     '<span class="handle ui-sortable-handle">\n' +
                    //     '<i class="fas fa-ellipsis-v"></i>\n' +
                    //     '<i class="fas fa-ellipsis-v"></i>\n' +
                    //     '</span>\n' +
                    //     '<div class="icheck-primary d-inline ml-2">\n' +
                    //     '<input type="checkbox" value="'+ shipment.id +'" name="id[]" id="shipment-'+ shipment.id +'" required>\n' +
                    //     '<label for="shipment'+ shipment.id +'"></label>\n' +
                    //     '</div>\n' +
                    //     '<span class="text">'+ shipment.shipment_number +'</span>\n' +
                    //     '</li>');

                    // $('#receive-mawb .unselected-shipment').append('<div class="custom-control custom-checkbox">\n' +
                    //     '<input class="custom-control-input" type="checkbox" name="id[]" id="shipment-'+ shipment.id +'" value="'+ shipment.id +'">\n' +
                    //     '<label for="shipment'+ shipment.id +'" class="custom-control-label">'+ shipment.shipment_number +'</label>\n' +
                    //     '</div>');

                    $('#receive-mawb .unselected-shipment').append('<li class="select-item" style="">\n' +
                        '<span class="handle ui-sortable-handle">\n' +
                        '<i class="fas fa-ellipsis-v"></i>\n' +
                        '<i class="fas fa-ellipsis-v"></i>\n' +
                        '</span>\n' +
                        '<div class="form-check d-inline ml-2">\n' +
                        '<input type="checkbox" class="form-check-input" name="id[]" id="shipment-'+ shipment.id +'" value="'+ shipment.id +'">\n' +
                        '<label class="form-check-label" for="shipment-'+ shipment.id +'">'+ shipment.shipment_number +'</label>\n' +
                        '</div>' +
                        '</li>');
                });
            },
            error: function(response) {
                // $('#titleError').text(response.responseJSON.errors.title);
                // $('#descriptionError').text(response.responseJSON.errors.description);

                // $('#message').addClass('notice-error');
                // $('#message p').html('متاسفانه عملیات با موفقیت انجام نشد.');
                // $('#message').slideDown().delay(3000).slideUp();
            }
        });
    });

    $(document).on('click', '.store-receive-mawb', function (e) {
        if($('.unselected-shipment').children().length > 0)
            toastr.error('لطفا وضعیت کلیه مرسوله ها را مشخص نمایید.');

        else if($('.mawb-fraction').children().length > 0 && $('#fraction_file').val() == "") {
            toastr.error('لطفا نامه کسر تخلیه را آپلود نمایید.');
            $('#fraction_file').attr('required', 'required');
        }

        // if($('.selected-shipment').children().length != 0)
        else
            $('.store-receive-mawb-submit').click();

    });


    /* #################  Shipments  ################# */
    /* ############################################### */


    /* ############################################### */
    /* #################  Settings  ################## */

    $(document).on('click', '.add-language, .add-customer-group, .add-payment-method', function () {
        var selected = $(this).data('name');
        $('.'+selected+'-box .row:last').clone().appendTo($('.'+selected+'-box'));
        $('.'+selected+'-box .row:last').find('input[name=deleted\\[\\]]').remove();
        $('.'+selected+'-box .row:last').find('input').val('');
        $('.'+selected+'-box .row:last').show();
    });

    $(document).on('click', '.delete-language, .delete-customer-group, .delete-payment-method', function () {
        var selected = $(this).data('name');
        $(this).parent().parent().parent().parent().find('input[name='+selected+'_deleted\\[\\]]').val(1);
        $(this).parent().parent().parent().parent().hide();
    });


    /* #################  Settings  ################## */
    /* ############################################### */




});
