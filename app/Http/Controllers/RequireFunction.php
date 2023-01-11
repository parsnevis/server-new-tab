<?php


namespace App\Http\Controllers;


use App\Models\City;
use App\Models\Country;
use App\Models\County;
use App\Models\Currency;
use App\Models\Province;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RequireFunction
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public static function getRoute()
    {
        return explode('.', Route::currentRouteName());
    }

    public static function setLang()
    {
//        $_auth = Auth::User();
//        dd($_auth);
//        app()->setLocale(Auth::User()->default_language);
    }

    public static function siteSettings()
    {
        if(!empty(Setting::where('setting_name', 'site_url')->first()) && Setting::where('setting_name', 'site_url')->first() != null) {
            $site_url = Setting::where('setting_name', 'site_url')->first()->setting_value;
            $site_name_en = Setting::where('setting_name', 'site_name_en')->first()->setting_value;
            $site_name_fa = Setting::where('setting_name', 'site_name_fa')->first()->setting_value;
            $site_logo = json_decode(Setting::where('setting_name', 'site_logo')->first()->setting_value)[0]->url;
            $site_logo_small = json_decode(Setting::where('setting_name', 'site_logo_small')->first()->setting_value)[0]->url;
            $site_favicon = Setting::where('setting_name', 'site_favicon')->first()->setting_value;
            $site_languages = json_decode(Setting::where('setting_name', 'site_languages')->first()->setting_value);
            $invoice_roles = Setting::where('setting_name', 'invoice_roles')->first()->setting_value;
            $tax = Setting::where('setting_name', 'tax')->first()->setting_value;
        } else {
            $site_url = config('site_setting.project_url');
            $site_name_en = config('site_setting.project_name_en');
            $site_name_fa = config('site_setting.project_name_fa');
            $site_logo = config('site_setting.project_logo');
            $site_logo_small = config('site_setting.project_logo_small');
            $site_favicon = config('site_setting.project_favicon');
            $site_languages = config('site_setting.project_languages');
        }

        $siteSettings = array(
            'version' => config('site_setting.version'),
            'site_url' => $site_url,
            'site_name_en' => $site_name_en,
            'site_name_fa' => $site_name_fa,
            'site_logo' => $site_logo,
            'site_logo_small' => $site_logo_small,
            'site_favicon' => $site_favicon,
            'site_languages' => $site_languages,
            'invoice_roles' => $invoice_roles,
            'tax' => $tax,
        );

        return $siteSettings;
    }

    public static function customerGroup()
    {
        $customer_groups = json_decode(Setting::where('setting_name', 'customer_groups')->first()->setting_value);

        return $customer_groups;
    }

    public static function countries()
    {
        return $countries = Country::all();
    }

    public static function provinces()
    {
        return $provinces = Province::all();
    }

    public static function counties()
    {
        return $counties = County::all();
    }

    public static function sections()
    {
        return $sections = Section::all();
    }

    public static function cities()
    {
        return $cities = City::all();
    }

    public static function allStatus()
    {
        $status = array(
            array('id' => 1, 'title' => 'request'),
            array('id' => 2, 'title' => 'receiving information'),
            array('id' => 3, 'title' => 'pickup'),
            array('id' => 4, 'title' => 'input warehouse'),
            array('id' => 5, 'title' => 'forward'),
            array('id' => 6, 'title' => 'receiving shipment'),
            array('id' => 7, 'title' => 'customs'),
            array('id' => 8, 'title' => 'clearance'),
            array('id' => 9, 'title' => 'output warehouse'),
            array('id' => 10, 'title' => 'ready deliver'),
            array('id' => 11, 'title' => 'delivery'),
            array('id' => 12, 'title' => 'delivered'),
            array('id' => 13, 'title' => 'canceled'),
            array('id' => 14, 'title' => 'suspended'),
        );

        return json_decode(json_encode($status));
//        return array('request', 'receiving information', 'pickup', 'input warehouse', 'forward',
//            'receiving shipment', 'customs', 'clearance', 'output warehouse', 'ready deliver', 'delivery',
//            'delivered', 'canceled', 'suspended');
    }

    public static function requestStatusCount($import_export)
    {
        return $shipment = Shipment::where(function ($query) use ($import_export) {
            if ($import_export != 'index')
                $query->where('import_export', $import_export);
        })
        ->where('status', 'request')->count();

//        return count(Shipment::where('status', 'request')->get());
    }

    public static function inter_domest()
    {
        return array('international', 'domestic');
    }

    public static function import_export()
    {
        return array('import', 'export');
    }

    public static function productTypes()
    {
        return array('document', 'non_document', 'danger_product');
    }

    public static function currencies()
    {
        return Currency::all();
    }

    public static function paymentMethods()
    {
        return json_decode(Setting::where('setting_name', 'payment_methods')->first()->setting_value);
    }

    public static function validExtensions()
    {
        return json_decode(Setting::where('setting_name', 'valid_extensions')->first()->setting_value);
    }

    public static function siteCurrency()
    {
        $site_currency = Setting::where('setting_name', 'site_currency')->first()->setting_value;
        return Currency::where('id', $site_currency)->first();
    }

}
