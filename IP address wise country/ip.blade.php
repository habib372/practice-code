<?php


use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function getCountry(Request $request)
    {
        // Get user's IP address
        $ip = $request->ip();

        // Make a request to the IP geolocation service
        $client = new Client();
        $response = $client->get('https://api.ipgeolocation.io/ipgeo?apiKey=YOUR_API_KEY&ip=' . $ip);

        // Parse the response JSON
        $data = json_decode($response->getBody(), true);

        // Extract the country name
        $countryName = $data['country_name'];

        // Display the country name
        return "The user is from $countryName.";
    }
}
