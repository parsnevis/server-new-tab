@extends('layouts.app')

@section('style')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

<?php
use \Morilog\Jalali\Jalalian;
use \Morilog\Jalali\CalendarUtils;
use App\functions\HijriDate;
?>

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $year }}</div>

                <div class="card-body">

                    <form action="{{ route('ceartor') }}" method="POST">
                        @csrf
                        <input type="hidden" name="year" value="{{ $year }}">





                        @if($db_date == null)

                            @foreach($months as $month_key => $month)
                                <div class="month">
                                    <legend>{{ $jalali_months[$month_key] }}</legend>

                                    <?php $array_day = []; ?>
                                    @if($month == 12)
                                        <?php $days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29]; ?>
                                    @elseif($month > 6)
                                        <?php $days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30]; ?>
                                    @endif

                                    @foreach($days as $day_key => $day)

                                        <?php
                                        $jalali_date = $year . "/" . ($month) . "/" . ($day);
                                        $jalali_date_array = explode("/", $jalali_date);

                                        $gregorian_date = CalendarUtils::toGregorian($jalali_date_array[0], $jalali_date_array[1], $jalali_date_array[2]);
                                        $gregorian_date = implode('/', $gregorian_date);
                                        $hijri = new HijriDate( strtotime($gregorian_date) );
                                        $hijri_date = $hijri->get_year() . "/" . $hijri->get_month() . "/" . $hijri->get_day();
                                        ?>

                                        <div class="day">
                                            <span class="day-title">{{ $text_number[$day_key] }}</span>
                                            <input type="text" name="jalali[{{$month}}][{{$day}}]" value="{{ $jalali_date }}" class="jalali" placeholder="شمسی">
                                            <input type="text" name="gregorian[{{$month}}][{{$day}}]" value="{{ $gregorian_date }}" class="gregorian" placeholder="میلادی">
                                            <input type="text" name="hijri[{{$month}}][{{$day}}]" value="{{ $hijri_date }}" class="hijri" placeholder="قمری">
                                            <div class="holiday">
                                                <label for="">تعطیل است؟</label>
                                                <input type="checkbox" name="holiday[{{$month}}][{{$day}}]">
                                            </div>
                                            <input type="text" name="holiday_event[{{$month}}][{{$day}}]" class="holiday" placeholder="رویداد تعطیلی">
                                        </div>
                                    @endforeach

                                </div>
                            @endforeach

                        @else
                            <?php
                                unset($db_date['id']);
                                unset($db_date['year']);
                                unset($db_date['created_at']);
                                unset($db_date['updated_at']);
                            ?>
                            @for($i=1; $i<=12; $i++)

                                <div class="month">
                                    <?php
                                        $month_key = $i;
                                        $days = (array)json_decode($db_date['_'.$i]);
                                    ?>
                                    <legend>{{ $jalali_months[$month_key-1] }}</legend>

                                    <?php
                                        unset($days['start_day_number']);
                                        unset($days['include_gregorian_month']);
                                        unset($days['include_hijri_month']);
                                    ?>
                                    @foreach($days as $day_key => $day)
                                        <div class="day">
                                            <span class="day-title">{{ $text_number[$day_key-1] }}</span>
                                            <input type="text" name="jalali[{{$i}}][{{$day_key}}]" value="{{ $day->jalali->date }}" class="jalali" placeholder="شمسی">
                                            <input type="text" name="gregorian[{{$i}}][{{$day_key}}]" value="{{ $day->gregorian->date }}" class="gregorian" placeholder="میلادی">
                                            <input type="text" name="hijri[{{$i}}][{{$day_key}}]" value="{{ $day->hijri->date }}" class="hijri" placeholder="قمری">
                                            <div class="holiday">
                                                <label for="">تعطیل است؟</label>
                                                <input type="checkbox" name="holiday[{{$i}}][{{$day_key}}]" {{ $day->holiday->is == 'on' ? 'checked' : '' }}>
                                            </div>
                                            <input type="text" name="holiday_event[{{$i}}][{{$day_key}}]" value="{{ $day->holiday->event }}" class="holiday" placeholder="رویداد تعطیلی">
                                        </div>
                                    @endforeach

                                </div>
                            @endfor
                            {{-- @foreach($db_date as $month_key => $month)
                            <?php //dd($month_key, $month); ?>

                            @endforeach --}}

                        @endif



                        <input type="submit" class="btn btn-primary" value="ذخیره">


                        {{-- <div class="month">
                            <div class="day">
                                <input type="text" name="jalali[1][1]" placeholder="شمسی">
                                <input type="text" name="gregorian[1][1]" placeholder="میلادی">
                                <input type="text" name="hijri[1][1]" placeholder="قمری">
                                <div class="holiday">
                                    <label for="">تعطیل است؟</label>
                                    <input type="checkbox" name="holiday">
                                </div>
                                <input type="text" name="holiday-event[1][1]" placeholder="رویداد تعطیلی">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="ذخیره"> --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/script.js') }}" defer></script>
@endsection
