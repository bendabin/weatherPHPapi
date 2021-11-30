<?php
/*
    The following PHP script communicates with the openweathermap.org API server. It receives a POST request from the 
    user's browser and then sends the request to the site's API. The script receives the response from the API as a JSON 
    object which is sent to the user's browser.
*/

    class WeatherApi
    {
        //Global variables 
        const url = "https://api.openweathermap.org/data/2.5/";
        public $apiKey;
        // public $data;

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

            //return JSON data
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
    }

    /*#########################################################
      #                 The program starts here               #
      #########################################################
    */    

    //Wait for the POST request to be received from the user's web browser (City Name search box) 
    if (isset($_POST['cityName'])) {
      
        //Get the values from the web browser form data POST request and generate a parameter array 
        $cityName = $_POST['cityName']; 
        $units = $_POST['units'];
        $parameters = ["q" => $cityName, "units" => $units]; //parameters from input form

        /* Using the form data an API call will be developed in the form of a URL, which will send a request to the 
           API server to receive the data. 2 API calls will be created in the form of class of objects, One object being the
           current weather data and the other being the forecast.         
        */
        try {          

            //Create a new weather app object and initalise it with the API key
            $app = new WeatherApi("b173832c1411fa6ef53b66016aa8fee4");

            //Generate 2 app calls and get the JSON data from the server. 
            $currentWeather = $app->apiCall("weather", $parameters);
            $forecastWeather = $app->apiCall("forecast", $parameters);

            //send the current and forecast data to AJAX 
            $weatherData = array("weather" => $currentWeather, "forecast" => $forecastWeather);
            
            //
            echo json_encode($weatherData); 
    
        } catch (Exception $e) {
            //If the API data is invalid and an exception is thrown the following code will be executed back to the user
            
            /*
                This part of the code is still in development need to implement a new feature. 
            */
            echo $e->getMessage();
        }
    }

?>