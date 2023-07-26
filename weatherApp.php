<?php
  if(array_key_exists('submit', $_GET)){

    if(!$_GET['city']){
      $error = "Sorry, the input field is empty";
    }

    if ($_GET['city']){
      $apiData = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q='
      .$_GET['city'].
      '&appid=3d08458ec722ba2d08662c405e67b465');
        $weatherArray = json_decode($apiData, true);

        if($weatherArray['cod'] == 200){
          $tempCelsius = $weatherArray['main']['temp'] - 273;
          $weather = '<b>'.$weatherArray['name'].', '.$weatherArray['sys']['country'].', '.intval($tempCelsius).' &deg; </b> <br>';
          $weather .= '<b>Weather Condition: </b>'.$weatherArray['weather']['0']['description'].'<br>';
          $weather .= '<b>Atmosperic Pressure: </b>'.$weatherArray['main']['pressure'].'hPa <br>';
          $weather .= '<b>Wind Speed: </b>'.$weatherArray['wind']['speed'].' meter/sec <br>';
          $weather .= '<b>Cloudness: </b>'.$weatherArray['clouds']['all'].'% <br>';
        } else{
          $error = 'Could not be process, your city name is not valid';
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  
  <title>Weather App</title>

  <style>
    body{
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
      background-image: url(https://developer-blogs.nvidia.com/wp-content/uploads/2022/01/AdobeStock_169221286-e1642525416888.jpeg);
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      color: white;
      font-family: poppin, 'Times New Roman', Times, serif;
      font-size: large;
    }
    .container{
      text-align: center;
      justify-content: center;
      align-items: center;
      width: 440px;
    }
      h1{
        font-weight: 700;
        margin-top: 150px;
      }
      input{
        width: 350px;
        padding: 5px;
      }
  </style>

</head>

<body>

  <div class="container">
    <h1>Search Global Weather</h1>

    <form action="" method="GET">

      <p></p><label for="city">Enter your city name</label></p>
      <p><input type="text" name="city" id="city" placeholder="City Name"></p>
      <button type="submit" name="submit" class="btn btn-success">Submit Now</button>

      <div class="output mt-3">

        <?php 
        if($weather){
          echo '<div class="alert alert-success" role="alert">
          '. $weather.
          '</div>';
        }
        if ($error){
          echo '<div class="alert alert-danger" role="alert">
          '. $error.
          '</div>';
        }
        ?>

      </div>

    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>