<?php

class Weather {

    public static function getWeatherData($city) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=".__APIKEY__);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl), true);
        if(isset($result['weather'])) {
            $date = new DateTime("now");
            $output = "<h1>{$_POST['city']} Weather Status</h1>";
            $output .= "<p>".date_format($date, 'l g:i a')."</p>";
            $output .= "<p>".date_format($date, 'jS F, Y')."</p>";
            $output .= "<p>{$result['weather'][0]['description']}</p>";
            $output .= "<p><img src='https://openweathermap.org/img/w/{$result['weather'][0]['icon']}.png'/> {$result['main']['temp_max']}°C {$result['main']['temp_min']}°C</p>";
            $output .= "<p>Humidity: {$result['main']['humidity']}%</p>";
            $output .= "<p>Wind: {$result['wind']['speed']} km/h</p>";
            return $output;
        } else {
            return "<h2>Something went wrong</h2>";
        }
    }
}