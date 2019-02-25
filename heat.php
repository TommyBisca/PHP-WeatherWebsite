<!DOCTYPE html public "-//W3C//DTD HTML 4.0 //EN">
<!--Tommy Bisca CPT 283 3/18/18 Program1.-->

<html>
  <head>
    <style type="text/css">
        h1
        {
          color: #0000e6;
          margin-left: 75px;
        }
        h3
        {
            color: #ff1a75;
            margin-left: 135px;
        }
        #Weather
        {
          font-family: monospace;
          border-collapse: collapse;
        }
        #Weather th
        {
          text-align: center;
          background-color: #ffd9b3;
          padding: 22px;
          border: 4px solid #000066;
        }
        #Weather td
        {
          text-align: center;
          background-color: #ffffb3;
          border: 4px solid #000066;
          padding: 22px;
        }

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <title>Weather Wizards</title>
    </style>
</head>

<body>
<?php

  $temperature = 90;
  $relaHum = 63;
  $heatIndex = 0;
  $fN1 = -42.379;
  $fN2 = 2.04901523;
  $fN3 = 10.14333127;
  $fN4 = 0.22475541;
  $fN5 = 0.00683783;
  $fN6 = 0.05481717;
  $fN7 = 0.00122874;
  $fN8 = 0.00085282;
  $fN9 = 0.00000199;

$page_title = 'Heat Index';
include ('includes/header.html');

?>
  <h1> Heat Index </h1>
  <p>In the Summer, when people say '"It’s not the heat, it’s the humidity"', what do they
      mean? There are 2 factors that make a hot day feel really hot. The first is the air
      temperature and the second is relative humidity. After taking measurements for
      temperature and relative humidity, we can calculate a heat index that is called our “feels
      like” temperature.</p>
  <p>HI means Heat Index (the “Feels Like” Temperature). </p>
  <p>T means the air temperature (This formula works when temperatures are in the range of
  <b>80 to 112</b>). </p>
  <p>RH means relative humidity (This formula works when relative humidity is in the range
  of <b>13 to 85</b>) </p>
<br><br><br>
<form name="heat.php" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
  <fieldset>
        <legend>Get the Heat Index:</legend>
        Temperature:<br>
        <input name="temperature" type="number"
        <br><br><br>
        Humidity:<br>
        <input name="humidity" type="number"
        <br><br><br>
        <input type="submit" value="Gimme the heat index!">
  </fieldset>
</form>
<br><br>
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (!empty($_POST['temperature']))
    {
      $temperature = $_POST['temperature'];
      if (($temperature <= 112 && $temperature >= 80))
      {
        $temperature = $temperature;
      }
      else {
        echo "<span style='color: red'>Please enter a temperature within the range of 80-112.</span><br>";
        echo "<span style='color: red'>Please try again.</span><br>";
        $temperature = NULL;
      }
    }

    if (!empty($_POST['humidity']))
      $relaHum = $_POST['humidity'];
      if (($relaHum <= 85 && $relaHum >= 13))
      {
        $relaHum = $relaHum;
      }
      else {
        echo "<span style='color: red'>Please enter a relative humidity within the range of 13-85.</span><br>";
        echo "<span style='color: red'>Please try again.</span><br>";
        $relaHum = NULL;
      }
  }

  if (($temperature != NULL && $relaHum != NULL))
  {
    $heatIndex = number_format ($fN1 + $fN2 * $temperature + $fN3 * $relaHum -
    $fN4 * $temperature * $relaHum - $fN5 * $temperature * $temperature - $fN6 *
    $relaHum * $relaHum + $fN7 * $temperature * $temperature * $relaHum + $fN8
    * $temperature * $relaHum * $relaHum - $fN9 * $temperature * $temperature
    * $relaHum * $relaHum, 2);
  }

if ((isset($_POST['temperature'])) && (isset($_POST['humidity'])) && ($relaHum <= 85 && $relaHum >= 13) && ($temperature <= 112 && $temperature >= 80))
{
echo "<br><span style='color: red'>Today's Heat Index is: $heatIndex</span>";
echo "<br><span style='color: green'>Enter a new set of values if desired.</span>";
}
?>
  <p>If you need to take the temperature, but don't have a Thermometer, then see our Weather Workshops to
  find a workshop on How to make a Thermometer.</p><a href="workshops.php">Weather Workshops</a>
  <p>If you need to measure the relative humidity, but don't have a Hygrometer. Don't worry, we have a
  Weather Workshops that shows you how to make a Hygrometer too!</p><a href="workshops.php">Weather Workshops</a>
  <p>(You can go to the website for those other guys The Weather Channel to get these measurements, but
  taking measurements from them isn't as much fun as doing it yourself.</p><a href="https://weather.com/">The Weather website</a>
  </body>
<?php include ('includes/footer.html'); ?>
</html>
