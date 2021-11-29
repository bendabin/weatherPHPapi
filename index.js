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

                //Change the elements on the html page 
                $('.city-name').html(currentWeather.name);  

                // $("#iconUrl").html(weatherIconUrl).src;
                document.getElementById('iconUrlId').src= weatherIconUrl;

                $('.current-temp').html(currentWeather.main.temp + " °C");
                $('.weather-type').html(currentWeather.weather[0].description);
                $('.cloud-cover').html(currentWeather.clouds.all);
                $('.humidity').html(currentWeather.main.humidity);
                $('.wind-speed').html(currentWeather.wind.speed);
                                          
            
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