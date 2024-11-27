<?php



use Carbon\Carbon;
use GuzzleHttp\Client;

// function prx($arr)
// {
//     echo "<pre>";
//     print_r($arr);
//     die();
// }


function generateRandomString($length = 30)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function engToBn($number){
    $eng_to_bn = array('1'=>'১', '2'=>'২', '3'=>'৩', '4'=>'৪', '5'=>'৫','6'=>'৬', '7'=>'৭', '8'=>'৮', '9'=>'৯', '0'=>'০');

    $bn_number = strtr($number,$eng_to_bn);
    return $bn_number;
}


// Date to age convert - 10Y 5M
function calculateAgeToday($date)
{
    //Take patient's dob and return age today
    if (empty($date)) {
        return '';
    }
    $datetime1 = new DateTime($date);
    $datetime2 = new DateTime(date('Y-m-d'));
    $interval = $datetime1->diff($datetime2);

    return $interval->format('%yY %mM');
}

function convertDateTime($datetime)
{
    $dateTimeObj = new DateTime($datetime);

    // Format the DateTime object to the desired format- 2024-02-22 02:30 PM
    $formattedDateTime = $dateTimeObj->format('Y-m-d h:i A');

    return $formattedDateTime;
}

// Format the DateTime object to the desired format- 25th April, 2024
if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return Carbon::parse($date)->isoFormat('Do MMMM, YYYY');
    }
}

// Format the DateTime object to the desired format- 02:30 PM
if (!function_exists('formatTime')) {
    function formatTime($time)
    {
        return Carbon::parse($time)->format('h:i A');
    }
}


//get USER Data and IP address base on Country
function getGeolocationData($user_ip)
{
    if ($user_ip) {
        $ip = $user_ip;
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    // Make a request to the IP geolocation service
    $client = new Client();
    $response = $client->get('https://api.ipgeolocation.io/ipgeo?apiKey=024d33e025f2425fbd81f274acb3737b&ip=' . $ip);

    // Parse the response JSON
    $data = json_decode($response->getBody(), true);

    // Extract the required information
    $geolocation = [
        'ip' => $data['ip'],
        'country_name' => $data['country_name'],
        'country_code2' => $data['country_code2'],
        'country_code3' => $data['country_code3'],
        'currency_code' => $data['currency']['code'],
        'currency_name' => $data['currency']['name'],
        'currency_symbol' => $data['currency']['symbol'],
        'timezone' => $data['time_zone']['name'],
        'current_time' => $data['time_zone']['current_time']
    ];

    return $geolocation;
}
