@extends('reseller.layouts.reseller')

@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="input-group" style="direction: rtl">
                        <input type="text" id="shipment_number" name="shipment_number" class="form-control" placeholder="{{ __('lang.' . strtoupper('shipment_number')) }}" value="">
                        <span class="input-group-append">
                            <button type="button" class="btn btn-success float-right submit_track">{{ __('lang.' . strtoupper('Search')) }}</button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 track-box">

                    <div class="table-responsive">
                        <table class="widefat table table-striped text-center table-clients no-footer" id="table-shipments">

                            <thead>
                            <tr>
                                <th class="id">{{ __('lang.' . strtoupper('#')) }}</th>
                                <th class="shipment-number">{{ __('lang.' . strtoupper('date')) }}</th>
                                <th class="">{{ __('lang.' . strtoupper('location')) }}</th>
                                <th class="">{{ __('lang.' . strtoupper('description')) }}</th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>

                        </table>
                    </div>

                <script>
                    $(document).ready(function () {
                        $(document).on('click','.submit_track',function () {
                            load_track();
                        });
                    });

                    function load_track() {

                        var track_number =  $('#shipment_number').val();


                        // let _url = 'https://portal.samanexp.com/track_shipment';
                        let _url = '/api/track_shipment';
                        let _token = $('meta[name="csrf-token"]').attr('content');
                        let _method   = 'POST';

                        $.ajax({
                            url: _url,
                            type: "POST",
                            data: {
                                _method: _method,
                                _token: _token,

                                track_number: track_number,

                                // id: id,
                                ajax_activated: 1,
                                // activated: activated
                            },
                            success: function(response) {
                                console.log(response);
                                let origin = response.origin;
                                let destination = response.destination;
                                let history = response.history;
                                let events = response.events;

                                var newRowsContent='';
                                // response=jQuery.parseJSON(response)
                                $('#recieve_location').html(destination.name_en);
                                $('#sender_location').html(origin.name_en);


                                for (var i = history.length-1; i >= 0; i--) {

                                    let persian_desc = "";
                                    let english_desc = "";
                                    $.each(events, function (){
                                        if(this.id == history[i]['event_id'])
                                        {
                                            persian_desc = this.name_fa;
                                            english_desc = this.name_en;
                                            return false;
                                        }
                                    });

                                    var date = history[i]['date'].split(' ')[0];
                                    var time = history[i]['date'].split(' ')[1];

                                    date = date.split('-');
                                    var year = date[0];
                                    var month = date[1];
                                    var day = date[2];
                                    var month_name = '';

                                    switch (month)
                                    {
                                        case '01':
                                            month_name = 'Jan';
                                            month_full_name = 'January';
                                            break;

                                        case '02':
                                            month_name = 'Feb';
                                            month_full_name = 'February';
                                            break;

                                        case '03':
                                            month_name = 'Mar';
                                            month_full_name = 'March';
                                            break;

                                        case '04':
                                            month_name = 'Apr';
                                            month_full_name = 'April';
                                            break;

                                        case '05':
                                            month_name = 'May';
                                            month_full_name = 'May';
                                            break;

                                        case '06':
                                            month_name = 'Jun';
                                            month_full_name = 'June';
                                            break;

                                        case '07':
                                            month_name = 'Jul';
                                            month_full_name = 'July';
                                            break;

                                        case '08':
                                            month_name = 'Aug';
                                            month_full_name = 'August';
                                            break;

                                        case '09':
                                            month_name = 'Sep';
                                            month_full_name = 'September';
                                            break;

                                        case '10':
                                            month_name = 'Oct';
                                            month_full_name = 'October';
                                            break;

                                        case '11':
                                            month_name = 'Nov';
                                            month_full_name = 'November';
                                            break;

                                        case '12':
                                            month_name = 'Des';
                                            month_full_name = 'December';
                                            break;
                                    }

                                    newRowsContent+='<tr class="track_heading">' +
                                        '<td>'+(response['history'].length-i)+'</td>' +
                                        '<td>'+day +' '+ month_name + ' , '+ year +' - '+ time +'</td>' +
                                        '<td>'+response['history'][i]['location']+'</td>' +
                                        // '<td>'+response['history'][i]['description']+'</td>' +
                                        '<td>' +
                                            '<p class="english">' + english_desc + '</p>' +
                                            '<p class="persian">' + persian_desc + '</p>' +
                                        '</td>' +

                                        '</tr>';
                                }

                                $(".track-box table tbody").children().remove();
                                $(".track-box table tbody").append(newRowsContent);
                            },
                            error: function(response) {
                            }
                        });

                    }



                    // function load_track() {
                    //
                    //     var track_number =  $('#shipment_number').val();
                    //
                    //
                    //     // let _url = 'https://portal.samanexp.com/track_shipment';
                    //     let _url = '/api/track_shipment';
                    //     let _token = $('meta[name="csrf-token"]').attr('content');
                    //     let _method   = 'POST';
                    //
                    //     $.ajax({
                    //         url: _url,
                    //         type: "POST",
                    //         data: {
                    //             _method: _method,
                    //             _token: _token,
                    //
                    //             track_number: track_number,
                    //
                    //             // id: id,
                    //             ajax_activated: 1,
                    //             // activated: activated
                    //         },
                    //         success: function(response) {
                    //             console.log(response);
                    //             let origin = response.origin;
                    //             let destination = response.destination;
                    //             let history = response.history;
                    //             let events = response.events;
                    //
                    //             var newRowsContent='';
                    //             // response=jQuery.parseJSON(response)
                    //             $('#recieve_location').html(destination.name_en);
                    //             $('#sender_location').html(origin.name_en);
                    //
                    //
                    //             for (var i = history.length-1; i >= 0; i--) {
                    //
                    //                 let desc = "";
                    //                 $.each(events, function (){
                    //                     if(this.id == history[i]['event_id'])
                    //                     {
                    //                         desc = this.name_fa;
                    //                         return false;
                    //                     }
                    //                 });
                    //
                    //                 var date = history[i]['date'].split(' ')[0];
                    //                 var time = history[i]['date'].split(' ')[1];
                    //
                    //                 date = date.split('-');
                    //                 var year = date[0];
                    //                 var month = date[1];
                    //                 var day = date[2];
                    //                 var month_name = '';
                    //
                    //                 switch (month)
                    //                 {
                    //                     case '01':
                    //                         month_name = 'Jan';
                    //                         month_full_name = 'January';
                    //                         break;
                    //
                    //                     case '02':
                    //                         month_name = 'Feb';
                    //                         month_full_name = 'February';
                    //                         break;
                    //
                    //                     case '03':
                    //                         month_name = 'Mar';
                    //                         month_full_name = 'March';
                    //                         break;
                    //
                    //                     case '04':
                    //                         month_name = 'Apr';
                    //                         month_full_name = 'April';
                    //                         break;
                    //
                    //                     case '05':
                    //                         month_name = 'May';
                    //                         month_full_name = 'May';
                    //                         break;
                    //
                    //                     case '06':
                    //                         month_name = 'Jun';
                    //                         month_full_name = 'June';
                    //                         break;
                    //
                    //                     case '07':
                    //                         month_name = 'Jul';
                    //                         month_full_name = 'July';
                    //                         break;
                    //
                    //                     case '08':
                    //                         month_name = 'Aug';
                    //                         month_full_name = 'August';
                    //                         break;
                    //
                    //                     case '09':
                    //                         month_name = 'Sep';
                    //                         month_full_name = 'September';
                    //                         break;
                    //
                    //                     case '10':
                    //                         month_name = 'Oct';
                    //                         month_full_name = 'October';
                    //                         break;
                    //
                    //                     case '11':
                    //                         month_name = 'Nov';
                    //                         month_full_name = 'November';
                    //                         break;
                    //
                    //                     case '12':
                    //                         month_name = 'Des';
                    //                         month_full_name = 'December';
                    //                         break;
                    //                 }
                    //
                    //                 newRowsContent+='<tr class="track_heading">' +
                    //                     '<td>'+(response['history'].length-i)+'</td>' +
                    //                     '<td>'+day +' '+ month_name + ' , '+ year +' - '+ time +'</td>' +
                    //                     '<td>'+response['history'][i]['location']+'</td>' +
                    //                     // '<td>'+response['history'][i]['description']+'</td>' +
                    //                     '<td>'+desc+'</td>' +
                    //
                    //                     '</tr>';
                    //             }
                    //
                    //             $(".track-box table tbody").children().remove();
                    //             $(".track-box table tbody").append(newRowsContent);
                    //         },
                    //         error: function(response) {
                    //         }
                    //     });
                    //
                    //
                    //
                    //     // $.ajax({
                    //     //     url: _url,
                    //     //     type: "POST",
                    //     //     data: {
                    //     //         _method: _method,
                    //     //         _token: _token,
                    //     //
                    //     //         track_number: track_number,
                    //     //
                    //     //         // id: id,
                    //     //         ajax_activated: 1,
                    //     //         // activated: activated
                    //     //     },
                    //     //     success: function(response) {
                    //     //         console.log(response);
                    //     //         let origin = response.origin;
                    //     //         let destination = response.destination;
                    //     //         let history = response.history;
                    //     //         let events = response.events;
                    //     //
                    //     //         var newRowsContent='';
                    //     //         // response=jQuery.parseJSON(response)
                    //     //         $('#recieve_location').html(destination.name_en);
                    //     //         $('#sender_location').html(origin.name_en);
                    //     //
                    //     //         // for (var i = 0; i < response['history'].length; i++) {
                    //     //         for (var i = history.length-1; i >= 0; i--) {
                    //     //
                    //     //             var date = history[i]['date'].split(' ')[0];
                    //     //             var time = history[i]['date'].split(' ')[1];
                    //     //
                    //     //             date = date.split('-');
                    //     //             var year = date[0];
                    //     //             var month = date[1];
                    //     //             var day = date[2];
                    //     //             var month_name = '';
                    //     //
                    //     //             switch (month)
                    //     //             {
                    //     //                 case '01':
                    //     //                     month_name = 'Jan';
                    //     //                     month_full_name = 'January';
                    //     //                     break;
                    //     //
                    //     //                 case '02':
                    //     //                     month_name = 'Feb';
                    //     //                     month_full_name = 'February';
                    //     //                     break;
                    //     //
                    //     //                 case '03':
                    //     //                     month_name = 'Mar';
                    //     //                     month_full_name = 'March';
                    //     //                     break;
                    //     //
                    //     //                 case '04':
                    //     //                     month_name = 'Apr';
                    //     //                     month_full_name = 'April';
                    //     //                     break;
                    //     //
                    //     //                 case '05':
                    //     //                     month_name = 'May';
                    //     //                     month_full_name = 'May';
                    //     //                     break;
                    //     //
                    //     //                 case '06':
                    //     //                     month_name = 'Jun';
                    //     //                     month_full_name = 'June';
                    //     //                     break;
                    //     //
                    //     //                 case '07':
                    //     //                     month_name = 'Jul';
                    //     //                     month_full_name = 'July';
                    //     //                     break;
                    //     //
                    //     //                 case '08':
                    //     //                     month_name = 'Aug';
                    //     //                     month_full_name = 'August';
                    //     //                     break;
                    //     //
                    //     //                 case '09':
                    //     //                     month_name = 'Sep';
                    //     //                     month_full_name = 'September';
                    //     //                     break;
                    //     //
                    //     //                 case '10':
                    //     //                     month_name = 'Oct';
                    //     //                     month_full_name = 'October';
                    //     //                     break;
                    //     //
                    //     //                 case '11':
                    //     //                     month_name = 'Nov';
                    //     //                     month_full_name = 'November';
                    //     //                     break;
                    //     //
                    //     //                 case '12':
                    //     //                     month_name = 'Des';
                    //     //                     month_full_name = 'December';
                    //     //                     break;
                    //     //             }
                    //     //
                    //     //             // newRowsContent+='<li class="timeline-item">' +
                    //     //             //     '<div class="timeline-info">' +
                    //     //             //     '<span>' + month_name + ' ' + day + ',' + year + '</span>' +
                    //     //             //     '</div>' +
                    //     //             //     '<div class="timeline-marker"></div>' +
                    //     //             //     '<div class="timeline-content">' +
                    //     //             //     '<h3 class="timeline-title">' + response['history'][i]['location'] + '</h3>' +
                    //     //             //     '<p>' + response['history'][i]['description'] + '</p>' +
                    //     //             //     '</div>' +
                    //     //             //     '</li>';
                    //     //             //
                    //     //             //
                    //     //             // if(response['history'][i-1] && response['history'][i]['date'].split(' ')[0].split('-')[1] != response['history'][i-1]['date'].split(' ')[0].split('-')[1])
                    //     //             //     newRowsContent+='<li class="timeline-item period">' +
                    //     //             //         '<div class="timeline-info"></div>' +
                    //     //             //         '<div class="timeline-marker"></div>' +
                    //     //             //         '<div class="timeline-content">' +
                    //     //             //         '<h2 class="timeline-title">'+month_full_name+'</h2>' +
                    //     //             //         '</div>' +
                    //     //             //         '</li>';
                    //     //
                    //     //             newRowsContent+='<tr class="track_heading">' +
                    //     //                 '<td>'+(response['history'].length-i)+'</td>' +
                    //     //                 '<td>'+day +' '+ month_name + ' , '+ year +' - '+ time +'</td>' +
                    //     //                 '<td>'+response['history'][i]['description']+'</td>' +
                    //     //                 '<td>'+response['history'][i]['location']+'</td>' +
                    //     //                 '</tr>';
                    //     //         }
                    //     //
                    //     //         $(".track-box table tbody").children().remove();
                    //     //         $(".track-box table tbody").append(newRowsContent);
                    //     //         // $(".track-box ul.timeline").html(newRowsContent);
                    //     //         // $(".track-box").show('slow');
                    //     //
                    //     //     },
                    //     //     error: function(response) {
                    //     //         // $('#titleError').text(response.responseJSON.errors.title);
                    //     //         // $('#descriptionError').text(response.responseJSON.errors.description);
                    //     //
                    //     //         // $('#message').addClass('notice-error');
                    //     //         // $('#message p').html('متاسفانه عملیات با موفقیت انجام نشد.');
                    //     //         // $('#message').slideDown().delay(3000).slideUp();
                    //     //     }
                    //     // });
                    //
                    // }

                </script>

            </div>
        </div>
        </div>
    </section>
















    <!-- Main content -->
{{--    <section class="content">--}}
{{--        <div class="container-fluid">--}}
{{--            <!-- Small boxes (Stat box) -->--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-6">--}}
{{--                    <!-- small box -->--}}
{{--                    <div class="small-box bg-info">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>150</h3>--}}

{{--                            <p>New Orders</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-bag"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ./col -->--}}
{{--                <div class="col-lg-3 col-6">--}}
{{--                    <!-- small box -->--}}
{{--                    <div class="small-box bg-success">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>53<sup style="font-size: 20px">%</sup></h3>--}}

{{--                            <p>Bounce Rate</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-stats-bars"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ./col -->--}}
{{--                <div class="col-lg-3 col-6">--}}
{{--                    <!-- small box -->--}}
{{--                    <div class="small-box bg-warning">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>44</h3>--}}

{{--                            <p>User Registrations</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-person-add"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ./col -->--}}
{{--                <div class="col-lg-3 col-6">--}}
{{--                    <!-- small box -->--}}
{{--                    <div class="small-box bg-danger">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>65</h3>--}}

{{--                            <p>Unique Visitors</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-pie-graph"></i>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ./col -->--}}
{{--            </div>--}}
{{--            <!-- /.row -->--}}


{{--        </div><!-- /.container-fluid -->--}}
{{--    </section>--}}
    <!-- /.content -->

@endsection

