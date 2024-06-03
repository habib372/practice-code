
<!-- just now", "1 minute ago", "5 minutes ago", "1 hour ago", "10 hours ago", "1 day ago", "3 days ago", etc. -->
<?php

use Carbon\Carbon;

// publish date convert
function publishTime($date) {
    $timestamp = Carbon::parse($date);
    $now = Carbon::now();
    $diffInMinutes = $timestamp->diffInMinutes($now);
    $localLanguage = app()->getLocale() == 'en';

    if ($diffInMinutes < 1) {
        $difference = $localLanguage ? 'just now' : 'এইমাত্ৰ';
    }
    elseif ($diffInMinutes < 60) {
        $difference = $localLanguage ? $diffInMinutes . ($diffInMinutes > 1 ? ' minutes' : ' minute') . ' ago' : engToBn($diffInMinutes) . ($diffInMinutes > 1 ? ' মিনিট' : ' মিনিট') . ' আগে';

    }
    elseif ($diffInMinutes < 1440) {
        $diffInHours = floor($diffInMinutes / 60);
        $difference = $localLanguage ? $diffInHours . ($diffInHours > 1 ? ' hours' : ' hour') . ' ago' : engToBn($diffInHours) . ($diffInHours > 1 ? ' ঘন্টা' : ' ঘন্টা') . ' আগে';
    }
    else {
        $diffInDays = $timestamp->diffInDays($now);
        $difference = $localLanguage ? $diffInDays . ($diffInDays > 1 ? ' days' : ' day') . ' ago' :  
        engToBn($diffInDays) . ($diffInDays > 1 ? ' দিন' : ' দিন') . ' আগে';
    }

    return $difference;
}


 function engToBn($number){
    $eng_to_bn = array('1'=>'১', '2'=>'২', '3'=>'৩', '4'=>'৪', '5'=>'৫','6'=>'৬', '7'=>'৭', '8'=>'৮', '9'=>'৯', '0'=>'০');

    $bn_number = strtr($number,$eng_to_bn);
    return $bn_number;
}