<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function getWeather($city)
    {
        $client = new Client();
        $apiKey = '';
        $response = $client->$request('GET','', [
            'query' => [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric'
            ]
        ]);

        $weatherData = json_decode($response->getBody(), true);
        $temperature = $weatherData['main']['temp'];

        return view('weather', ['temperature'=>$temperature]);
    }
}
