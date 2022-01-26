<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use \Morilog\Jalali\Jalalian;
use \Morilog\Jalali\CalendarUtils;
use App\functions\HijriDate;
use App\Models\Date;

class CalController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // require(app_path() . '\functions\jdf.php');
        require(app_path() . '\functions\HijriDate.php');

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $months = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

        $days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
        $cal_types = ["jalali", "gregorian", "hijri"];




        // $jalali_today = jdate("Y/n/j",'','','','en');
        $jalali_today = Jalalian::now()->format("Y/n/j",'','','','en');


        $call = [];
        $call['today']['date'] = $jalali_today;
        $call['today']['day']['number'] = jdate("w", '', '', '', 'en');
        $call['today']['day']['name'] = jdate("l");


        foreach($months as $month_key => $month)
        {
            foreach($days as $day_key => $day)
            {
                if(!($month > 6 and $day > 30))
                {
                    foreach($cal_types as $cal_type)
                    {
                        $jalali_date = Jalalian::now()->format("Y",'','','','en') . "/" . ($month_key+1) . "/" . ($day_key+1);
                        $jalali_date_array = explode("/", $jalali_date);

                        // dd($jalali_date_array[0], $jalali_date_array[1], $jalali_date_array[2], "/");
                        $gregorian_date = CalendarUtils::toGregorian($jalali_date_array[0], $jalali_date_array[1], $jalali_date_array[2]);
                        $gregorian_date = implode('/', $gregorian_date);
                        $hijri = new HijriDate( strtotime($gregorian_date) );
                        $hijri_date = $hijri->get_year() . "/" . $hijri->get_month() . "/" . $hijri->get_day();

                        if($cal_type == "jalali")
                        {
                            $call[$month][$day][$cal_type]["date"] = $jalali_date;
                            $call[$month][$day][$cal_type]["event"] = [];
                        }

                        if($cal_type == "gregorian")
                        {
                            $call[$month][$day][$cal_type]["date"] = $gregorian_date;
                            $call[$month][$day][$cal_type]["event"] = [];
                        }

                        if($cal_type == "hijri")
                        {
                            $call[$month][$day][$cal_type]["date"] = $hijri_date;
                            $call[$month][$day][$cal_type]["event"] = [];
                        }



                        // $str_time = jmktime( 0 , 0 , 0 , ($month_key+1) , ($day_key+1) , jdate("Y",'','','','en') );
                        $str_time = Jalalian::fromFormat('n/j/Y', ($month_key+1) . '/' . ($day_key+1) . '/' . Jalalian::now()->format("Y",'','','','en'))->getTimestamp();

                        // $call[$month][$day]['day']['number'] = jdate("w", $str_time,'','','en')+1;
                        $call[$month][$day]['day']['number'] = $date = Jalalian::forge($str_time)->format("w");
                        // $call[$month][$day]['day']['name'] = jdate("l", $str_time);
                        $call[$month][$day]['day']['name'] = $date = Jalalian::forge($str_time)->format("l");


                        // $str_time = jmktime( 0 , 0 , 0 , ($month_key+1) , (1) , jdate("Y",'','','','en') );
                        $str_time = Jalalian::fromFormat('n/j/Y', ($month_key+1) . '/' . (1) . '/' . Jalalian::now()->format("Y",'','','','en'))->getTimestamp();
                        // $call[$month]['start_day_number'] = jdate("w", $str_time,'','','en')+1;
                        $call[$month]['start_day_number'] = $date = Jalalian::forge($str_time)->format("w");

                    }
                }
            }
        }


        $call = json_encode($call);
        echo $call;








    }

    public function check_conectivity()
    {
        return true;
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cal()
    {
        require(app_path() . '\functions\HijriDate.php');

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $months = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

        $days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
        // dd(count($days));

        $cal_types = ["jalali", "gregorian", "hijri"];


        $jalali_today = Jalalian::now()->format("Y/n/j",'','','','en');

        $call = [];
        $array_month = [];

        $call['today']['date'] = $jalali_today;
        $call['today']['day']['number'] = jdate("w", '', '', '', 'en');
        $call['today']['day']['name'] = jdate("l");

        foreach($months as $month_key => $month)
        {
            $array_day = [];
            if($month == 12)
                $days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29];
            else if($month > 6)
                $days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];

            foreach($days as $day_key => $day)
            {
                foreach($cal_types as $cal_type)
                {
                    $jalali_date = Jalalian::now()->format("Y",'','','','en') . "/" . ($month_key+1) . "/" . ($day_key+1);
                    $jalali_date_array = explode("/", $jalali_date);

                    $gregorian_date = CalendarUtils::toGregorian($jalali_date_array[0], $jalali_date_array[1], $jalali_date_array[2]);
                    $gregorian_date = implode('/', $gregorian_date);
                    $hijri = new HijriDate( strtotime($gregorian_date) );
                    $hijri_date = $hijri->get_year() . "/" . $hijri->get_month() . "/" . $hijri->get_day();

                    if($cal_type == "jalali")
                    {
                        $array_day[$day][$cal_type]["date"] = $jalali_date;
                        $array_day[$day][$cal_type]["event"] = [];
                    }

                    if($cal_type == "gregorian")
                    {
                        $array_day[$day][$cal_type]["date"] = $gregorian_date;
                        $array_day[$day][$cal_type]["event"] = [];
                    }

                    if($cal_type == "hijri")
                    {
                        $array_day[$day][$cal_type]["date"] = $hijri_date;
                        $array_day[$day][$cal_type]["event"] = [];
                    }

                    $str_time = Jalalian::fromFormat('n/j/Y', ($month_key+1) . '/' . ($day_key+1) . '/' . Jalalian::now()->format("Y",'','','','en'))->getTimestamp();

                    $array_day[$day]['day']['number'] = $date = Jalalian::forge($str_time)->format("w");
                    $array_day[$day]['day']['name'] = $date = Jalalian::forge($str_time)->format("l");
                }
            }
            $str_time = Jalalian::fromFormat('n/j/Y', ($month_key+1) . '/' . (1) . '/' . Jalalian::now()->format("Y",'','','','en'))->getTimestamp();
            $array_day['start_day_number'] = $date = Jalalian::forge($str_time)->format("w");

            $array_month[$month] = json_encode($array_day);
        }
        $array_month['year'] = $jalali_date_array[0];


        $data = ['_1' => $array_month[1], '_2' => $array_month[2], '_3' => $array_month[3], '_4' => $array_month[4], '_5' => $array_month[5], '_6' => $array_month[6],
        '_7' => $array_month[7], '_8' => $array_month[8], '_9' => $array_month[9], '_10' => $array_month[10], '_11' => $array_month[11], '_12' => $array_month[12]];


        $db_date = Date::where('year', $jalali_date_array[0])->first();
        if($db_date)
        {
            Date::where('year', $jalali_date_array[0])->update($data);
        }
        else
        {
            $data['year'] = $jalali_date_array[0];
            Date::create($data);
        }

        $call = json_encode($call);
        echo $call;
    }


    /**
     * @param string $year
     * @param string $month
     */
    public function get_date($year, $month)
    {
        $selected = '_'.$month;
        return Date::select('year', $selected)->where('year', $year)->first();
    }







}
