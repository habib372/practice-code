<!--  app/helpers.php -->
if (!function_exists('formatNumber')) {
    function formatNumber($number) {
    return number_format($number, 0, '.', ',');
    }
}

<!--  app/helpers.php -->
public static function engToBn($number){
$eng_to_bn = array('1'=>'১', '2'=>'২', '3'=>'৩', '4'=>'৪', '5'=>'৫','6'=>'৬', '7'=>'৭', '8'=>'৮', '9'=>'৯', '0'=>'০');

$bn_number = strtr($number,$eng_to_bn);
return $bn_number;
}


<!---app/provider/appServiceProvider.php-->
public function boot(Request $request)
{
    Blade::directive('convert', function ($amount) {
        return "<?php echo app()->getLocale() === 'en' ? number_format($amount, 0) : App\Helpers\Helper::engToBn(number_format($amount, 0)); ?>";

    });
}

example: @convert($ads->price)