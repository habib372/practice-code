

<!-- Controller -->
<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function getCountry(Request $request)
    {
        // Get user's IP address

        $ip = $request->ip(); //or
        // $ip = $_SERVER["REMOTE_ADDR"];
        // $ip = "103.102.221.255";

        // Make a request to the IP geolocation service
        $client = new Client();
        $response = $client->get('https://api.ipgeolocation.io/ipgeo?apiKey=YOUR_API_KEY&ip=' . $ip);

        // Parse the response JSON
        $data = json_decode($response->getBody(), true);

        // Extract the country name
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

        // Display the country name
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
