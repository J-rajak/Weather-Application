<?php
$servername = "localhost";
$database = "db2227264";
$username = "root";
header('Access-Control-Allow-Origin: *');
$password = 123456;

// Creating connection
$conn = mysqli_connect($servername, $username, $password, $database);



// Checking connection
if (!$conn) {
  die("<b> Connection failed: </b>" . mysqli_connect_error());
}


?>
<?php
// Select weather data for given parameters
$sql = "SELECT *
FROM weather_table
ORDER BY wether_time DESC limit 1";
$result = $conn -> query($sql);
// If 0 record found

$url =("https://api.openweathermap.org/data/2.5/weather?q=New york&appid=fca3e6733f79c1f38544de07eadb3e6d&units=metric");
// Get data from openweathermap and store in JSON object
$data = file_get_contents($url);
$json = json_decode($data, true);
// Fetch required fields
$city_name= $json['name'];
$country_name= $json ['sys']['country'];
$temp= $json['main']['temp'];
$humidity= $json['main']['humidity'];
$pressure= $json['main']['pressure'];
$data =$json['weather'][0]['description'];
$wind_s = $json['wind']['speed'];
$wind_d= $json['wind']['deg'];
$img= $json['weather'][0]['icon'];
$wether_time = date("Y-m-d H:i:s"); // now


// Build INSERT SQL statement
$sql = "INSERT INTO weather_table(city_name,country_name,humidity,temperature,pressure,data,wind_s,wind_d,img,wether_time)
VALUES('{$city_name}','{$country_name}','{$humidity}','{$temp}', '{$pressure}','{$data}','{$wind_s}', '{$wind_d}', '{$img}','{$wether_time}')";

// Run SQL statement and report errors
if (!$conn -> query($sql)) {
echo("<h4>SQL error description: " . $conn -> error . "</h4>");

}
?>
<?php
$sql = "SELECT * FROM weather_table ORDER BY wether_time DESC limit 1";
$result = $conn -> query($sql);

// Get data, convert to JSON and print
$row = $result -> fetch_assoc();
print json_encode($row);
// Free result set and close connection
$result -> free_result();
$conn -> close();

?>