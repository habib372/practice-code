<?php

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
