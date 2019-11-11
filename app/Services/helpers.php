<?php

use App\Setting;

function getPrefix() {
    if (request()->route()) {
        return request()->route()->getPrefix();
    }else{
        return LaravelLocalization::getCurrentLocale();
    }
}

function get_view($view, $params) {
    if(request()->is('api/*') OR request()->is('api')){
        return $params;
    }else{
        return view($view, $params);
    }
}

function settings() {
    $settings = Setting::all();

    $result = [];
    $result['app_name'] = '';
    $result['contact_phone'] = '';
    $result['contact_email'] = '';
    $result['contact_adress'] = '';

    $result['seo_title'] = '';
    $result['seo_keyword'] = '';
    $result['seo_description'] = '';

    $result['facebook_link'] = '';
    $result['twitter_link'] = '';
    $result['google_link'] = '';
    $result['instagram_link'] = '';
    $result['linkedin_link'] = '';
    $result['environment'] = 'locale';


    foreach ($settings as $setting) {
        $result[$setting->key] = $setting->value;
    }
    return $result;
}
