<?php 

include_once 'db/connect.php';


if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}


?>



<!DOCTYPE HTML>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>vieworder</title>

  <link rel="stylesheet" href="css/style.css">
</head>
<?php include 'header.php'; ?>

<body>

<!-- custom js file link -->
<script src="js/script.js"></script>

<?php include 'alert.php'; ?>

</body>


</html>