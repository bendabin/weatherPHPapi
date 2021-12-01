<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Weather Dash</title>

    <!-- CSS Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7d6671dfd4.js" crossorigin="anonymous"></script>

    <!-- Bootstrap Libaries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <!--
     ################################################## Navigation bar ############################################ 
    -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 py-4">
        <div class="container-fluid">
            <!--navigation bar -->
            <a class="navbar-brand" href="">Weather Forecast Dash</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerMin" aria-controls="navbarTogglerMin" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerMin">
                <ul class="navbar-nav mx-auto">

                    <li class="nav-item ">

                        <div class="weather-controls">

                            <form class="d-flex" method="post">
                                <input class="form-control" type="text" name="cityName" id="cityName" placeholder="Enter city name *">

                                <input type="radio" name="units" id="metric" value="metric" checked />
                                <label for="metric">Celsius</label>

                                <input type="radio" name="units" id="imperial" value="imperial" />
                                <label for="imperial">Fahrenheit</label>

                                <button class="btn btn-dark" type="submit" id="submit_btn">Search</button>
                            </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!--
     ######################################### Weather Content Division ############################################ 
    -->
    <div class="fluid-container" id="weather-div">

        <!--        Current Weather forecast box         -->

        <h2>Current</h2>

        <div class="current-box row">

            <div class="forecast-box col">
                <h2 class="city-name"> City Name (Country) </h2>
                <h3 class="current-temp"> 20 degrees </h3>
                <img id="iconUrlId" scr="">
                <p class="weather-type"> Clear</p>
                <p class="cloud-cover"> Clouds:10%</p>
                <p class="humidity"> Humidity: 20%</p>
                <p class="precipitation"> Precipitation: 10%</p>
                <p class="wind-speed"> Wind Speed: 10 km/hr</p>
            </div>
        </div>

        <!--        Forecast box            -->
        <h2> Next 5 Days</h2>
        <div class="row">

            <div class="forecast-box col">
                <h3 class= "day1">Monday</h3>
                <h3 class="temp1"> 20 degrees </h3>
                <img id="iconUrlId1" scr="">
                <p class="weather1"> Clear</p>
                <p class="cloud1"> Clouds:10%</p>
                <p class="humidity1"> Humidity: 20%</p>
                <p class="precipitation1"> Precipitation: 10%</p>
                <p class="windspeed1"> Wind Speed: 10 km/hr</p>
            </div>

            <div class="forecast-box col-xl-2">

                <h3>Tuesday</h3>

            </div>

            <div class="forecast-box col-xl-2 col-lg-2">

                <h3>Wednesday</h3>

            </div>

            <div class="forecast-box col-xl-2 col-lg-2 col-md-2">

                <h3>Thursday</h3>

            </div>

            <div class="forecast-box col-xl-2 col-lg-2 col-md-2">

                <h3>Friday</h3>

            </div>

        </div>
    </div>

    <!--
     ######################################### Footer ############################################ 
    -->
    <footer class="footer">
        <p class="footer-heading">Copyright © 2021 Ben Dabin</p>
    </footer>

    <!-- Java script files here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="index.js" charset="utf-8"></script>
</body>

</html>