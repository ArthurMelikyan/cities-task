<?php

namespace App\Http\Controllers;

use App\Models\CityWeather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{

    public function fetchCities(){
        $cities = CityWeather::orderByDesc('id')->select('name','full_name','temperature','updated_at')->get();
        return response()->json($cities);
    }

    public function getWeather(Request $request){
        if ($request->lng && $request->lat) {
            $url = "https://api.openweathermap.org/data/2.5/weather";
            $data = Http::get("{$url}?units=metric&lat={$request->lat}&lon={$request->lng}&appid=".config('app.weather_api'));
            if ($data->ok()) {
                $data = $data->json();
                $current_temp = $data['main']['temp'];
                return response()->json(['errors' => false, 'temp' => $current_temp]);
            }
            return response()->json(['errors' => true]);
        }
    }

    public function saveWeather(Request $request){
        $save = CityWeather::updateOrCreate(
            ['place_id' => $request->data['placeId']],
            [
                'full_name' => $request->data['fullName'],
                'name' => $request->data['city'],
                'place_id' => $request->data['placeId'],
                'longitude' => $request->data['lng'],
                'latitude' => $request->data['lat'],
                'temperature' => $request->temp,
            ]
        );
        if ($save) {
            return response()->json(['errors' => false, 'message' => 'Successfully saved']);
        }
    }
}
// https://api.openweathermap.org/data/2.5/weather?lat=50.1109221&lon=8.6821267&appid=c718050391a59ccb7807ec04f907427f
