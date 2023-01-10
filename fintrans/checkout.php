<?php 

include_once 'db/connect.php';



if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_GET['get_id'])){
    $get_id = $_GET['get_id'];
}else{
    $get_id = '';
}

if(isset($_POST['place_order'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address_type = $_POST['address_type'];
    $address_type = filter_var($address_type, FILTER_SANITIZE_STRING);
    $address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST
    ['country'].' - '.$_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    if(isset($_GET['get_id'])){


      $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
      $get_product->execute($_GET['get_id']);
      if($get_product->rowCount() > 0){
        while($fetch_product = $get_product->fetch(PDO::FETCH_ASSOC)){
         $insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name, number,
        email, address, address_type, method, product_id, price, qty) VALUES
        (?,?,?,?,?,?,?,?,?,?)"); 
        $insert_order->execute([create_unique_id(), $user_id, $name, $number, $email,
        $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], 1]);
        $success_msg[] = 'order placed!';
        }
      }else{
        $warning_msg[] = 'something went wrong';
      }

    }
}
?>



<!DOCTYPE HTML>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>view_products</title>

  <?php include 'header.php'; ?>
  <link rel="stylesheet" href="css/style.css">
<!--- header section ends -->
<!-- checkout section starts -->
<section class="checkout">

<h1 class="heading">checkout summary</h1>

<div class="row">

<form action="" method="POST">
    <h3>billing details</h3>
    <div class="flex">
        <div class="box">
            <p>your name <span>*</span></p>
            <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="input">
            <p>your email <span>*</span></p>
            <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="input">
            <p>your number <span>*</span></p>
            <input type="number" name="number" required maxlength="10" placeholder="enter your number"  min="0" max="9999999" class="input">
                <p>payment method <span>*</span></p>
                <select name="method" class="input" required>
                    <option value="cash on delivery">cash on delivry</option>
                    <option value="net banking">net banking</option>
                    <option value="credit or debit card">credit or debit card</option>
                    <option value="UPI or RuPay">UPI or RuPay</option>
                </select>
        </div>
                <p>address type <span>*</span></p>
                <select name="address_type" class="input" required>
                    <option value="home">home</option>
                    <option value="office">office</option>
                </select>
        </div>
        <div class="box">
        <p>address line 01 <span>*</span></p>
            <input type="text" name="flat" required maxlength="50" placeholder="e.g flat no" class="input">
            <p>address line 02 <span>*</span></p>
            <input type="text" name="street" required maxlength="50" placeholder="e.g flat no" class="input">  
            <p>city name<span>*</span></p>
            <input type="text" name="city" required maxlength="50" placeholder="enter ur city name" class="input">  
            <p>country name<span>*</span></p>
            <input type="text" name="country" required maxlength="50" placeholder="enter ur city name" class="input">  
            <p>pin code <span>*</span></p>
            <input type="number" name="pin_code" required maxlength="6" placeholder="enter your number"  min="0" max="999" class="input">
        </div>
    </div>
    <input type="submit" value="place order" name="place_order" class="btn">
</form>
<div class="summary">
    <?php
    $grand_total = 0;
    if($get_id != ''){
        $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_product->execute([$get_id]);
        if($select_product->rowCount() > 0){
          while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
           $grand_total = $fetch_product['price'];
    ?>
    <div class="flex">
        <img src="img/<?= $fetch_product['image']; ?>" alt="">
        <div>
            <h3 class="name"><?= $fetch_product['name']; ?></h3>
            <p class="price">*<?= $fetch_product['price']; ?> x 1</p>
        </div>
    </div>

    <?php
            }
        }else{
         echo '<p class="empty">product was found!</p>';
        }
    }else{
        
    }

    ?>

    <p class="grand-total">grand total : <span>*</span></p>
</div>
</div>
</section>
<!-- checkout section ends -->


<script src="js/script.js"></script>

<?php include 'alert.php'; ?>


















