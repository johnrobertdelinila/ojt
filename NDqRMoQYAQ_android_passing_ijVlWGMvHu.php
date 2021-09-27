<?php
//url
//http://192.168.1.99/dtr_daams/NDqRMoQYAQ_android_passing_ijVlWGMvHu.php?status=&name=&date=&time1=&time2=&time3=&time4=&accomplishment=
//getting data
$status = $_GET['status'];
$name = $_GET['name'];
$date = $_GET['date'];
$time1 = $_GET['time1'];
$time2 = $_GET['time2'];
$time3 = $_GET['time3'];
$time4 = $_GET['time4'];
$accomplishment = $_GET['accomplishment'];


//variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dtr";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}




//queries
if($status == 'time1'){
	$sql = "insert into dtr (name, date, time1) VALUES ('$name','$date','$time1')";
}elseif($status == 'time2'){
	$sql = "update dtr set time2 = '$time2' where name='$name' and date='$date'";
}elseif($status == 'time3'){
	$sql = "update dtr set time3 = '$time3' where name='$name' and date='$date'";
}else{
	$sql = "update dtr set time4 = '$time4', accomplishment='$accomplishment' where name='$name' and date='$date'";
}
//queries









if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>