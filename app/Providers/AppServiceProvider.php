<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapThree();
        Paginator::defaultView('vendor/pagination/bootstrap-3');

        Validator::extend('national_code', function ($attribute, $nationalCode, $parameters, $validator) {

            if (!is_numeric($nationalCode) || strlen($nationalCode) != 10) {
                return false;
            }
            $check = intval($nationalCode[9]);
            $sum = 0;
            for ($x = 0; $x < 9; $x++) {
                $sum += intval($nationalCode[$x]) * (10 - $x);
            }
            $rem = $sum % 11;
            return ($rem < 2 && $rem == $check) || ($rem >= 2 && $check + $rem == 11);
        });

        Validator::extend('mobile', function ($attribute, $mobile, $parameters, $validator) {
//            'string', 'max:11', 'regex:/(\\+98|0)?9\\d{9}/'
//            dd(array($attribute, $mobile, $parameters, $validator));
//            $v = Validator::make([$attribute => $mobile], [$attribute => ['string', 'max:16', 'regex:/(\\+98|0)?9\\d{9}/']]);
            $v = Validator::make([$attribute => $mobile], [$attribute => ['string', 'max:18', 'regex:/((\\^[+]|\\d{1|2|3|4}|0)?\\d{5|6|7|8|9|10|11})|(\\+|98|0)?9\\d{9}/']]);
            if($v->fails()) {
                return false;
            }
            else
            {
                return true;
            }
        });
    }
}
