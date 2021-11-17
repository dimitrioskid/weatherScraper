<?php
    
    $error ="";
    $weather ="";
    
    if(array_key_exists("city", $_GET)){

        $_GET["city"] = str_replace(" ", "", $_GET["city"]);

        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$_GET['city']."/forecasts/latest");

        if($file_headers[0] == "HTTP/1.1 404 Not Found"){
            
            $error = "That city could not be found.";

        } else {
        $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$_GET['city']."/forecasts/latest");

            $pageArray = explode('3 days):</div><p class="location-summary__text"><span class="phrase">', $forecastPage);

            if(sizeof($pageArray) > 1) {

                $secondArray = explode('</span></p></div>', $pageArray[1]);

                if(sizeof($secondArray) > 1){

                    $weather = $secondArray[0];
                } else {

                    $error = "That city could not be found.";
                    
                }    
           
            } else {

                $error = "That city could not be found.";

            }

        }
    
    }


?>