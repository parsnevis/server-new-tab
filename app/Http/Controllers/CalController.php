<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\User;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use \Morilog\Jalali\Jalalian;
use \Morilog\Jalali\CalendarUtils;
use App\functions\HijriDate;
use App\Models\Contact;
use App\Models\Date;

class CalController extends Controller
{
    use ApiResponser;


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

        $days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
        $cal_types = ["jalali", "gregorian", "hijri"];




        // $jalali_today = jdate("Y/n/j",'','','','en');
        $jalali_today = Jalalian::now()->format("Y/n/j", '', '', '', 'en');


        $call = [];
        $call['today']['date'] = $jalali_today;
        $call['today']['day']['number'] = jdate("w", '', '', '', 'en');
        $call['today']['day']['name'] = jdate("l");


        foreach ($months as $month_key => $month) {
            foreach ($days as $day_key => $day) {
                if (!($month > 6 and $day > 30)) {
                    foreach ($cal_types as $cal_type) {
                        $jalali_date = Jalalian::now()->format("Y", '', '', '', 'en') . "/" . ($month_key + 1) . "/" . ($day_key + 1);
                        $jalali_date_array = explode("/", $jalali_date);

                        // dd($jalali_date_array[0], $jalali_date_array[1], $jalali_date_array[2], "/");
                        $gregorian_date = CalendarUtils::toGregorian($jalali_date_array[0], $jalali_date_array[1], $jalali_date_array[2]);
                        $gregorian_date = implode('/', $gregorian_date);
                        $hijri = new HijriDate(strtotime($gregorian_date));
                        $hijri_date = $hijri->get_year() . "/" . $hijri->get_month() . "/" . $hijri->get_day();

                        if ($cal_type == "jalali") {
                            $call[$month][$day][$cal_type]["date"] = $jalali_date;
                            $call[$month][$day][$cal_type]["event"] = [];
                        }

                        if ($cal_type == "gregorian") {
                            $call[$month][$day][$cal_type]["date"] = $gregorian_date;
                            $call[$month][$day][$cal_type]["event"] = [];
                        }

                        if ($cal_type == "hijri") {
                            $call[$month][$day][$cal_type]["date"] = $hijri_date;
                            $call[$month][$day][$cal_type]["event"] = [];
                        }



                        // $str_time = jmktime( 0 , 0 , 0 , ($month_key+1) , ($day_key+1) , jdate("Y",'','','','en') );
                        $str_time = Jalalian::fromFormat('n/j/Y', ($month_key + 1) . '/' . ($day_key + 1) . '/' . Jalalian::now()->format("Y", '', '', '', 'en'))->getTimestamp();

                        // $call[$month][$day]['day']['number'] = jdate("w", $str_time,'','','en')+1;
                        $call[$month][$day]['day']['number'] = $date = Jalalian::forge($str_time)->format("w");
                        // $call[$month][$day]['day']['name'] = jdate("l", $str_time);
                        $call[$month][$day]['day']['name'] = $date = Jalalian::forge($str_time)->format("l");


                        // $str_time = jmktime( 0 , 0 , 0 , ($month_key+1) , (1) , jdate("Y",'','','','en') );
                        $str_time = Jalalian::fromFormat('n/j/Y', ($month_key + 1) . '/' . (1) . '/' . Jalalian::now()->format("Y", '', '', '', 'en'))->getTimestamp();
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

        $days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
        // dd(count($days));

        $cal_types = ["jalali", "gregorian", "hijri"];


        $jalali_today = Jalalian::now()->format("Y/n/j", '', '', '', 'en');

        $call = [];
        $array_month = [];

        $call['today']['date'] = $jalali_today;
        $call['today']['day']['number'] = jdate("w", '', '', '', 'en');
        $call['today']['day']['name'] = jdate("l");

        foreach ($months as $month_key => $month) {
            $array_day = [];
            if ($month == 12)
                $days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29];
            else if ($month > 6)
                $days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];

            foreach ($days as $day_key => $day) {
                foreach ($cal_types as $cal_type) {
                    $jalali_date = Jalalian::now()->format("Y", '', '', '', 'en') . "/" . ($month_key + 1) . "/" . ($day_key + 1);
                    $jalali_date_array = explode("/", $jalali_date);

                    $gregorian_date = CalendarUtils::toGregorian($jalali_date_array[0], $jalali_date_array[1], $jalali_date_array[2]);
                    $gregorian_date = implode('/', $gregorian_date);
                    $hijri = new HijriDate(strtotime($gregorian_date));
                    $hijri_date = $hijri->get_year() . "/" . $hijri->get_month() . "/" . $hijri->get_day();

                    if ($cal_type == "jalali") {
                        $array_day[$day][$cal_type]["date"] = $jalali_date;
                        $array_day[$day][$cal_type]["event"] = [];
                    }

                    if ($cal_type == "gregorian") {
                        $array_day[$day][$cal_type]["date"] = $gregorian_date;
                        $array_day[$day][$cal_type]["event"] = [];
                    }

                    if ($cal_type == "hijri") {
                        $array_day[$day][$cal_type]["date"] = $hijri_date;
                        $array_day[$day][$cal_type]["event"] = [];
                    }

                    $str_time = Jalalian::fromFormat('n/j/Y', ($month_key + 1) . '/' . ($day_key + 1) . '/' . Jalalian::now()->format("Y", '', '', '', 'en'))->getTimestamp();

                    $array_day[$day]['day']['number'] = $date = Jalalian::forge($str_time)->format("w");
                    $array_day[$day]['day']['name'] = $date = Jalalian::forge($str_time)->format("l");
                }
            }
            $str_time = Jalalian::fromFormat('n/j/Y', ($month_key + 1) . '/' . (1) . '/' . Jalalian::now()->format("Y", '', '', '', 'en'))->getTimestamp();
            $array_day['start_day_number'] = $date = Jalalian::forge($str_time)->format("w");

            $array_month[$month] = json_encode($array_day);
        }
        $array_month['year'] = $jalali_date_array[0];


        $data = [
            '_1' => $array_month[1], '_2' => $array_month[2], '_3' => $array_month[3], '_4' => $array_month[4], '_5' => $array_month[5], '_6' => $array_month[6],
            '_7' => $array_month[7], '_8' => $array_month[8], '_9' => $array_month[9], '_10' => $array_month[10], '_11' => $array_month[11], '_12' => $array_month[12]
        ];


        $db_date = Date::where('year', $jalali_date_array[0])->first();
        if ($db_date) {
            Date::where('year', $jalali_date_array[0])->update($data);
        } else {
            $data['year'] = $jalali_date_array[0];
            Date::create($data);
        }

        $call = json_encode($call);
        echo $call;
    }



    public function get_calendar_dates()
    {
        $calendar_dates = Date::all()->makeHidden(['created_at', 'updated_at']);
        // dd($calendar_dates);

        // $calendar_dates = json_encode($calendar_dates);
        // $today = Jalalian::now()->format("Y/n/j",'','','','en');


        return $calendar_dates;
    }

    public function get_today()
    {
        $jalali_today = Jalalian::now()->format("Y/n/j", '', '', '', 'en');

        //        $today = [];
        //        $today['date'] = $jalali_today;
        //        $today['day']['number'] = Jalalian::now()->format("w", '', '', '', 'en');
        //        $today['day']['name'] = Jalalian::now()->format("l");

        $jalali_today = explode('/', $jalali_today);
        $year = $jalali_today[0];
        $month = $jalali_today[1];
        $day = $jalali_today[2];
        $month_dates = json_decode(Date::select('_' . $month)->where('year', $year)->first()->makeHidden(['created_at', 'updated_at'])['_' . $month]);
        $today = $month_dates->$day;
        $today->date = $jalali_today;

        return $today;
    }


    /**
     * @param string $year
     * @param string $month
     */
    public function get_date($year = null, $month = null)
    {
        $jalali_date = Jalalian::now()->format("Y/n/j", '', '', '', 'en');
        $jalali_date = explode('/', $jalali_date);
        //        dd($jalali_date);

        $selected = $month != null ? '_' . $month : '*';
        $year = $year != null ? $year : $jalali_date[0];
        // return json_encode(Date::select('year', $selected)->where('year', $year)->first());
        // return json_encode(Date::select('*')->where('year', $year)->first()->makeHidden(['created_at','updated_at' ]));

        $date = Date::select($selected)->where('year', $year)->first()->makeHidden(['created_at', 'updated_at']);
        $date['today'] = $jalali_date;

        //        return json_encode($date);
        return $date;
    }


    public function create_calendar($year)
    {
        require(app_path() . '/functions/HijriDate.php');

        $gregorian_months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $jalali_months = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شرویور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];
        $months = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        $days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
        $cal_types = ["jalali", "gregorian", "hijri"];
        $text_number = ['یکم', 'دوم', 'سوم', 'چهارم', 'پنجم', 'ششم', 'هفتم', 'هشتم', 'نهم', 'دهم', 'یازدهم', 'دوازدهم', 'سیزدهم', 'چهاردهم', 'پانزدهم', 'شانزدهم', 'هفدهم', 'هجدهم', 'نوزدهم', 'بیستم', 'بیست و یکم', 'بیست و دوم', 'بیست و سوم', 'بیست و چهارم', 'بیست و پنجم', 'بیست و ششم', 'بیست و هفتم', 'بیست و هشتم', 'بیست و نهم', 'سی ام', 'سی و یکم'];

        $db_date = Date::where('year', $year)->first();

        return view('create_calendar', compact('db_date', 'year', 'months', 'days', 'cal_types', 'jalali_months', 'text_number'));
    }


    public function ceartor(Request $request)
    {
        $gregorian_months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $hijri_months = ['محرم', 'صفر', 'ربیع الاول', 'ربیع الثانی', 'جمادی الاول', 'جمادی الثانی', 'رجب', 'شعبان', 'رمضان', 'شوال', 'ذی القعده', 'ذی الحجه'];


        $year = $request->year;
        $jalali = $request->jalali;
        $gregorian = $request->gregorian;
        $hijri = $request->hijri;
        $holiday = $request->holiday;
        $holiday_event = $request->holiday_event;
        $year_date = [];


        // dd($request->all());

        $month_date = [];
        foreach ($request->jalali as $key => $month) {
            // dd($month);
            foreach ($month as $jkey => $jalali_date) {
                // dd($jalali_date);
                $month_date[$jkey]['jalali']['date'] = $jalali_date;
                $month_date[$jkey]['jalali']['event'] = [];

                $month_date[$jkey]['gregorian']['date'] = $gregorian[$key][$jkey];
                $month_date[$jkey]['gregorian']['event'] = [];

                $month_date[$jkey]['hijri']['date'] = $hijri[$key][$jkey];
                $month_date[$jkey]['hijri']['event'] = [];

                $month_date[$jkey]['holiday']['is'] = isset($holiday[$key][$jkey]) ? $holiday[$key][$jkey] : 'off';
                $month_date[$jkey]['holiday']['event'] = $holiday_event[$key][$jkey];

                $str_time = Jalalian::fromFormat('Y/n/j', $jalali_date)->getTimestamp();
                $month_date[$jkey]['day']['number'] = Jalalian::forge($str_time)->format("w");
                $month_date[$jkey]['day']['name'] = Jalalian::forge($str_time)->format("l");
            }
            $str_time = Jalalian::fromFormat('Y/n/j', $year . '/' . ($key) . '/' . (1))->getTimestamp();
            $month_date['start_day_number'] = Jalalian::forge($str_time)->format("w");


            $first_day = 1;
            $last_day = 31;
            if ($key == 12) {
                unset($month_date[31]);
                unset($month_date[30]);
                $last_day = 29;
            } elseif ($key > 6) {
                unset($month_date[31]);
                $last_day = 30;
            }


            $first_gregorian = explode('/', $month_date[$first_day]['gregorian']['date']);
            $last_gregorian = explode('/', $month_date[$last_day]['gregorian']['date']);

            if ($first_gregorian[0] == $last_gregorian[0])
                $result_year = $first_gregorian[0];
            else
                $result_year = $first_gregorian[0] . ' - ' . $last_gregorian[0];

            if ($first_gregorian[1] == $last_gregorian[1])
                $result_gregorian = $gregorian_months[$first_gregorian[1] - 1] . ' ' . $result_year;
            else
                $result_gregorian = $gregorian_months[$first_gregorian[1] - 1] . ' - ' . $gregorian_months[$last_gregorian[1] - 1] . ' ' . $result_year;

            $month_date['include_gregorian_month'] = $result_gregorian;



            $first_hijri = explode('/', $month_date[$first_day]['hijri']['date']);
            $last_hijri = explode('/', $month_date[$last_day]['hijri']['date']);

            if ($first_hijri[0] == $last_hijri[0])
                $result_year = $first_hijri[0];
            else
                $result_year = $first_hijri[0] . ' - ' . $last_hijri[0];

            if ($first_hijri[1] == $last_hijri[1])
                $result_hijri = $hijri_months[$first_hijri[1] - 1] . ' ' . $result_year;
            else
                $result_hijri = $hijri_months[$first_hijri[1] - 1] . ' - ' . $hijri_months[$last_hijri[1] - 1] . ' ' . $result_year;

            $month_date['include_hijri_month'] = $result_hijri;



            $year_date['_' . $key] = json_encode($month_date);
        }


        $db_date = Date::where('year', $year)->first();

        if ($db_date) {
            $d = Date::where('year', $year)->update($year_date);
        } else {
            // $data = ['_1' => $year_date['_1'], '_2' => $year_date['_2'], '_3' => $year_date['_3'], '_4' => $year_date['_4'], '_5' => $year_date['_5'], '_6' => $year_date['_6'],
            // '_7' => $year_date['_7'], '_8' => $year_date['_8'], '_9' => $year_date['_9'], '_10' => $year_date['_10'], '_11' => $year_date['_11'], '_12' => $year_date['_12']];

            // $data['year'] = $year;
            // dd($data);
            // Date::create($data);

            $year_date['year'] = $year;
            $d = Date::create($year_date);
        }

        if ($d instanceof Date)
            echo 'سال ' . $year . 'با موفقیت ایجاد شد';
        else
            echo 'آپدیت سال ' . $year . 'با موفقیت ایجاد شد';


        // dd($year_date);

    }


    public function user_login_national_id(Request $request)
    {
        if ($request->has('national_id') and $request->has('password')) {
            $national_id = $request->national_id;
            $password = $request->password;

            //            $attr = $request->validate([
            //                'email' => 'required|string|email|',
            //                'password' => 'required|string|min:6'
            //            ]);

            $attr = [
                'national_id' => $national_id,
                'password' => $password
            ];

            if (!Auth::attempt($attr)) {
                return $this->error('Credentials not match', 401);
            }

            $user_array = [
                'first_name' => auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'nice_name' => auth()->user()->nice_name,
                'national_id' => auth()->user()->national_id,
                'email' => auth()->user()->email,
                'mobile' => auth()->user()->mobile,
                'phone' => auth()->user()->phone,
                'local_phone' => auth()->user()->local_phone,
                'profile_image' => auth()->user()->profile_image,
                'background_image' => auth()->user()->background_image,
                'reseller_id' => auth()->user()->reseller_id,
                'regions_id' => auth()->user()->regions_id,
                'position' => auth()->user()->position,
                //                'api_token' => auth()->user()->api_token,
                'activated_at' => auth()->user()->activated_at,
                'token' => auth()->user()->createToken('Chrome Extension Token')->plainTextToken,
            ];

            return $this->success([
                //                'token' => auth()->user()->createToken('Chrome Extension Token')->plainTextToken,
                //                'token' => auth()->user()->api_token,
                'user' => $user_array,
            ]);
        }
    }

    public function user_login_mobile(Request $request)
    {
        if ($request->has('mobile') and $request->has('password')) {
            $mobile = $request->mobile;
            $password = $request->password;

            //            $attr = $request->validate([
            //                'email' => 'required|string|email|',
            //                'password' => 'required|string|min:6'
            //            ]);

            $attr = [
                'mobile' => $mobile,
                'password' => $password
            ];

            if (!Auth::attempt($attr)) {
                return $this->error('Credentials not match', 401);
            }

            $user_array = [
                'first_name' => auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'nice_name' => auth()->user()->nice_name,
                'national_id' => auth()->user()->national_id,
                'email' => auth()->user()->email,
                'mobile' => auth()->user()->mobile,
                'phone' => auth()->user()->phone,
                'local_phone' => auth()->user()->local_phone,
                'profile_image' => auth()->user()->profile_image,
                'background_image' => auth()->user()->background_image,
                'reseller_id' => auth()->user()->reseller_id,
                'regions_id' => auth()->user()->regions_id,
                'position' => auth()->user()->position,
                //                'api_token' => auth()->user()->api_token,
                'activated_at' => auth()->user()->activated_at,
                'token' => auth()->user()->createToken('Chrome Extension Token')->plainTextToken,
            ];

            return $this->success([
                //                'token' => auth()->user()->createToken('Chrome Extension Token')->plainTextToken,
                //                'token' => auth()->user()->api_token,
                'user' => $user_array,
            ]);
        }
    }


    public function get_phonebook(Request $request)
    {
        $auth = auth()->user();
        $reseller = $auth->reseller;

        $regions = [];
        $phones = Contact::where('user_id', $auth->id)->with(['region'])->get()->makeHidden(['created_at', 'updated_at']);
        $phones = json_decode(json_encode($phones), true);

        if ($reseller->id != 1) {
            $regions = Region::where('reseller_id', $reseller->id)->get()->makeHidden(['created_at', 'updated_at']);

            $users = User::where([['reseller_id', $reseller->id], ['activated_at', '!=', null]])->with(['reseller', 'region'])->get()->makeHidden(['created_at', 'updated_at']);
            $users = json_decode(json_encode($users), true);
            foreach ($users as $user) {
                array_push($phones, $user);
            }
        }
        return ['regions' => $regions, 'phones' => $phones];
    }

    public function get_weather(Request $request)
    {
        //        http://api.weatherapi.com/v1/current.json?key=9a2b547179b14d53888111028222612&q=Tehran&aqi=no

        $weather = Http::retry(3, 100)->get('http://api.weatherapi.com/v1/current.json?key=9a2b547179b14d53888111028222612&q=Tehran&aqi=no');

        return $weather;
    }


    public function get_music(Request $request)
    {
        $musics = [];
        // $musics[0]->title = "Shadmehr Aghili - Adam Forosh";
        // $musics[0]->mp3 = "https://abazarak.ir/dl/Shadmehr Aghili - Adam Forosh [320].mp3";


        $musics[0] = array(
            'title' => "Shadmehr Aghili - Adam Forosh",
            'mp3' => "https://abazarak.ir/dl/Shadmehr Aghili - Adam Forosh [320].mp3"
        );

        $musics[1] = array(
            'title' => "Shadmehr Aghili - Avaz Nemishi",
            'mp3' => "https://abazarak.ir/dl/Shadmehr Aghili - Avaz Nemishi [320].mp3"
        );


        $musics[2] = array(
            'title' => "Shadmehr Aghili - Barandeh",
            'mp3' => "https://abazarak.ir/dl/Shadmehr Aghili - Barandeh [320].mp3"
        );

        $musics[3] = array(
            'title' => "Shadmehr Aghili - Baroon Delam Khast",
            'mp3' => "https://abazarak.ir/dl/Shadmehr Aghili - Baroon Delam Khast [320].mp3"
        );




        return $musics;

        // [{
        //     title:"Shadmehr Aghili - Adam Forosh",
        //     mp3:"https://abazarak.ir/dl/Shadmehr Aghili - Adam Forosh [320].mp3",
        //     // oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg"
        // },];
    }



    //    public function list_region(Request $request)
    //    {
    //        return Region::all();
    //    }
    //
    //    public function tel_number(Request $request)
    //    {
    //        return User::all();
    //    }


    //    public function get_time()
    //    {
    ////        $time = Carbon::now();
    //        $time = Jalalian::now()->format("H:i:s",'','','','en');
    //        return $time;
    //    }

}
