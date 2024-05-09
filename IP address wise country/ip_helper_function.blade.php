
<!-- Helper function -->
<?php

 use GuzzleHttp\Client;

    //get USER Data and IP address base on Country
    function getGeolocationData($ip)
    {
        // Make a request to the IP geolocation service
        $client = new Client();
        $response = $client->get('https://api.ipgeolocation.io/ipgeo?apiKey=YOUR_API_KEY&ip=' . $ip);

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



    //controller function
    class BuyPackageController extends Controller
    {

        public function buyPackage(Request $request)
        {
            $user_ip = $request->ip();
            // $user_ip = $_SERVER["REMOTE_ADDR"];
            // $user_ip = "103.102.221.255";

            $geolocationData = getGeolocationData($user_ip);

            // echo "<p>Country Name: ".$geolocationData['country_name'] ."</p>";
            // echo "<p>Country Code2:" . $geolocationData['country_code2'] ."</p>";
            // echo "<p>Country Code3:" . $geolocationData['country_code3'] ."</p>";
            // echo "<p>Currency Code:". $geolocationData['currency_code'] ."</p>";
            // echo "<p>Currency Symbol:".$geolocationData['currency_symbol']. "</p>";
            // echo "<p>Timezone:". $geolocationData['timezone'] ."</p>";
            // echo "<p>Current Time:" . $geolocationData['current_time']."</p>";


            return view('frontend.user.show', compact('geolocationData'));
        }
    }

?>


<!-- View file show.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Geolocation Data</title>
</head>
<body>
    <h1>Geolocation Data</h1>
    <p>Country Name: {{ $geolocationData['country_name'] }}</p>
    <p>Country Code2: {{ $geolocationData['country_code2'] }}</p>
    <p>Country Code3: {{ $geolocationData['country_code3'] }}</p>
    <p>Currency Code: {{ $geolocationData['currency_code'] }}</p>
    <p>Currency Symbol: {{ $geolocationData['currency_symbol'] }}</p>
    <p>Timezone: {{ $geolocationData['timezone'] }}</p>
    <p>Current Time: {{ $geolocationData['current_time'] }}</p>
</body>
</html>


<!-- output for bangladeshi IP -->
Country Name: Bangladesh
Country Code2:BD
Country Code3:BGD
Currency Code:BDT
Currency Symbol:৳
Timezone:Asia/Dhaka
Current Time:2024-05-07 15:37:48.156+0600
