<?php

    class WeatherApi
    {
        //Global variables 
        const url = "https://api.openweathermap.org/data/2.5/";
        public $apiKey;
        public $data;

        /*
        *   Sets the API key 
        */
        public function __construct($apiKey)
        {

            // check if api Key is set
            if (!isset($apiKey) or trim($apiKey) == '') {
                throw new Exception("Provide a valid API key!");
            }

            $this->apiKey = $apiKey;
        }

        /*
        *   Perform an API URL call to request a response from the API
        */

        public function apiCall($weatherType, $params)
        {

            //create the Api string 
            $apiURL = self::url . $weatherType;

            //check if parameters are empty 
            if (!empty($params)) {
                $apiURL = $apiURL . "?appid=" . $this->apiKey . "&" . str_replace("%2C", ",", http_build_query($params, null));
            } else {
                throw new Exception('The inputs have no attributes!');
            }

            //return JSON dat
            return $this->getAPIdata($apiURL);
        }

        /*

        * The function will get the API data from the specified URL and check the response code
        * If the function is successful it will return the API data if not exceptions will be thrown
        
        */
        private function getAPIdata($url)
        {

            //setting up the API call using curl
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_TIMEOUT, 3);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, $url);

            //getting API response 
            $response = curl_exec($curl);
            $responseInfo = curl_getinfo($curl);

            //Check the API response code
            switch ($responseInfo["http_code"]) {
                case 0:
                    throw new Exception("Timeout reached when callling " . $url);
                    break;
                case 200:
                    $data = $response;
                    break;
                case 401:
                    throw new Exception("Unauthorized request to " . $url . "; " . json_decode($response)->message);
                    break;
                case 404:
                    $data = null;
                    break;
                default:
                    throw new Exception("Connect to API failed with response: " . $responseInfo["http_code"]);
                    break;
            }
            return $data;
        }

        /*

        *   Extract the individual values from the API data response 
        */

        // public function readCurrentData()
        // {
        //     $data = json_decode($this->data, true);
        //     $temp = $data["main"]["temp"];
        //     return $temp;
        // }
    }

    /*

    *  The program starts here 

    */    

    if (isset($_POST['cityName'])) {

        //Store the JSON data for the current weather and forecast
        
        //Get the values from the user via AJAX POST
        $cityName = $_POST['cityName']; 
        $units = $_POST['units'];
        $parameters = ["q" => $cityName, "units" => $units]; //parameters from input form

        //Get the current weather data from the API
        try {          

            //Generate api calls for the current weather and forecast
            $app = new WeatherApi("b173832c1411fa6ef53b66016aa8fee4");

            //Get current weather data from api
            $currentWeather = $app->apiCall("weather", $parameters);
            
            //Get forecast data from the api
            $forecastWeather = $app->apiCall("forecast", $parameters);

            //send the current and forecast data to AJAX 
            $weatherData = array("weather" => $currentWeather, "forecast" => $forecastWeather);
            
            // echo strip_tags($currentWeather); 
            echo json_encode($weatherData); 
    
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

?>