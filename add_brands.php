
<?php
include('dbconnect.php');

$bname    = $_POST['bname'];
$bplate   = $_POST['bplate'];
$bdes    = $_POST['bdes'];

$query   = "INSERT into brands (bName,bPlate,bDes) VALUES('$bname ','$bplate','$bdes')";
mysql_query($query);

// echo "Thank You For submitting <br>";
// if (!$success) {
//     die("Couldn't enter data: ".$conn->error);

// }

// echo "Thank You For submitting <br>";



?>