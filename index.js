/*
    The following JavaScript file performs an Ajax on the PHP script, this allows for asynchronous communication between the browser on
    the client side and the PHP script on the server side, without the need of the user being redirected to a different page after 
    the search request has been submitted. The following script retrieves the values from the browser such as the "city name", 
    "units", etc and then POSTS them to the PHP script. If the user receives a successful response a function from the Ajax will be
    called and the data will be decoded and then displayed back to the user's browser as useful data. 
*/

$(document).ready(function(){

    /*
            Wait for the user to click search button when the search button is clicked, a post request is sent and
            data will be passed to a php script and then received back as a JSON via a ajax 
    */
    $("#submit_btn").click(function(e){

        e.preventDefault();


        //Get the values from the user input after POST request submitted 
        var cityName = document.getElementById("cityName").value;
        var units = document.querySelector('input[name="units"]:checked').value;

        //The AJAX
        $.ajax({

            type: "post",
            url: "apiweather.php",
            
            data:{
                cityName: cityName,
                units: units,
            },
            success: function(response){                
                
                //The recieved data will contain 2 JSON objects stored inside an encoded array for current and forecast weather
                //These sets of data will have to be encoded twice 
                var incomingData= JSON.parse(response);

                //Get the weather and forecast JSON objects from the data                
                var currentWeather = JSON.parse(incomingData["weather"]);
                var forecast = JSON.parse(incomingData["forecast"]);

                //Get weather current weather icon image
                var weatherIcon = currentWeather.weather[0].icon;                
                var weatherIconUrl = "http://openweathermap.org/img/wn/" + weatherIcon + "@2x.png";

                //Change the current forecast main div 
                $('.city-name').html(currentWeather.name); 
                // $("#iconUrl").html(weatherIconUrl).src;
                document.getElementById('iconUrlId').src= weatherIconUrl;
                $('.current-temp').html(currentWeather.main.temp + " °C");
                $('.weather-type').html(currentWeather.weather[0].description);
                $('.cloud-cover').html(currentWeather.clouds.all);
                $('.humidity').html(currentWeather.main.humidity);
                $('.wind-speed').html(currentWeather.wind.speed);

                //Change the 5 day forecast, The data contains a total of 40 samples, sample the data every 24 hours so 8 intervals
                
                //converting to user friendly data 
                const unixTimestamp = forecast.list[0].dt;
                const unixTimestampMS = unixTimestamp * 1000;
                // const dateObject = new Date(unixTimestampMS);

                displayValue(unixTimestampMS);



                // Calculation functions 
                function displayValue(time){

                    const dateObject = new Date(unixTimestampMS);
                    console.log(dateObject.toLocaleString("us-en", {weekday: "long"}));

                }


                // var format = {
                //     day: "numeric",
                //     month: "2-digit",
                //     year: "numeric"

                // };

                // console.log(dateObject.toLocaleString("ja", format));




                // console.log(dateObject.toLocaleString("us-en", {weekday: "long"}));
                
                
                
                // console.log((forecast.list[0].dt)).toUTCString();   //Get the timestamps for the forecast 
                // console.log((forecast.list[8].dt)).toUTCString();
                // console.log((forecast.list[16].dt).toUTCString());
                // console.log((forecast.list[24].dt).toUTCString());
                // console.log((forecast.list[32].dt).toUTCString()); 
                // console.log((forecast.list[39].dt).toUTCString()); 



                //
                //Get 
                // list[0].dt
                // list[1].dt
                // list[7].dt
                // list[8].dt
                // list[39].dt                                          
            
                // var data1 = JSON.parse(response);
                
                // var JSONdata = response.querySelector("body");

                // console.log(JSONdata);
             
                // console.log(phpData.main.temp);


                // $('.current-temp').html(temp);



                //retrieve the JSON data from the array
                // var dataJSON = response["weather"];


                // console.log(dataJSON);


                // //pass the data
                // var phpData = JSON.parse(data);

                // //Update the temperature 
                // var temp = phpData["main"]["temp"]; 

                // $('.city-name').html(cityName); 
                // $('.current-temp').html(temp);

                // $('.city-name').html(cityName);  
                // $('.current-temp').html(response);
                // $data = json_decode($this->data, true);
                // $temp = $data["main"]["temp"]; 
                
                // var phpData= JSON.parse(response); 
                // console.log(phpData);

            }
        });

    });


});

