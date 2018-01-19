
<?php
require_once 'dbconnect.php';

 // if session is not set this will redirect to login page

 // select loggedin users detail
 // $res=mysql_query("SELECT * FROM brands WHERE bId=".$_SESSION['user']);
 // $userRow=mysql_fetch_array($res);
$dbcon   = Connect();

 if ( isset($_POST['btn-add']) ) {

  // clean user inputs to prevent sql injections
  $bname = trim($_POST['bname']);
  $bname = strip_tags($bname);
  $bname = htmlspecialchars($bname);

  $bplate = trim($_POST['bplate']);
  $bplate = strip_tags($bplate);
  $bplate = htmlspecialchars($bplate);

  $bdes = trim($_POST['bdes']);
  $bdes = strip_tags($bdes);
  $bdes = htmlspecialchars($bdes);

  // basic name validation
  if (empty($bname)) {
   $error = true;
   $bnameError = "Please enter correct Brand name.";
  } else if (strlen($bname) < 3) {
   $error = true;
   $bnameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$bname)) {
   $error = true;
   $bnameError = "Name must contain alphabets and space.";
  }

  //basic email validation
  if ( !filter_var($bplate,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $bplateError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT userE FROM brands WHERE BrandPlateform='$bplate'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $bplateError = "Provided brand is already in use.";
   }
  }
  // password validation
  if (empty($bdes)){
   $error = true;
   $bdesError = "Please enter password.";
  } else if(strlen($bdes) < 6) {
   $error = true;
   $bdesError = "Password must have atleast 6 characters.";
  }

   // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO brands(bName,bPlate,bDes) VALUES('$bname','$bplate','$bdes')";
   $res = mysql_query($query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Data AddedSuccessfully";
    unset($bname);
    unset($bplate);
    unset($bdes);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later...";
   }

  }


 }
?>