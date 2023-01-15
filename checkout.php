<?php 
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon-cat.png"/>
    <link rel="stylesheet" href="./shop.css">
    <link rel="stylesheet" href="./checkout.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Checkout Page</title>
    <style>
        body{
            background: url("./images/backgroundImg.jpg");
        }
    </style>

</head>
<body>
    <?php include 'login_header.php'; ?>
    <section class="checkout-orders">
        <form action="" method="POST">
        <h3>Place order</h3>
        <div class="flex">
            <div class="inputBox">
                <span>Name :</span>
                <input type="text" name="name" class="box" required>
            </div>
            <div class="inputBox">
                <span>Card number :</span>
                <input type="number" name="number" class="box" required>
            </div>
            <div class="inputBox">
                <span>Email :</span>
                <input type="email" name="email" class="box" required>
            </div>
            <div class="inputBox">
                <span>Payment method :</span>
                <select name="method" class="box" required>
                <option value="cash on delivery">Cash on delivery</option>
                <option value="credit card">Credit card</option>
                <option value="Master card">Master card</option>
                <option value="American express">American express</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Expiry date :</span>
                <input type="text" name="date" class="box" required>
            </div>
            <div class="inputBox">
                <span>Address :</span>
                <input type="text" name="street" class="box" required>
            </div>
            <div class="inputBox">
                <span>city :</span>
                <input type="text" name="city" class="box" required>
            </div>
            <div class="inputBox">
                <span>Province :</span>
                <input type="text" name="state" class="box" required>
            </div>
            <div class="inputBox">
                <span>Country :</span>
                <input type="text" name="country" class="box" required>
            </div>
            <div class="inputBox">
                <span>Postal code :</span>
                <input type="text" name="postal_code" class="box" required>
            </div>
        </div>
        <?php
            $cart_grand_total = 0;
            $cart_QST = 0;
            $cart_GST = 0;
            $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart_items->execute([$user_id]);
            if($select_cart_items->rowCount() > 0){
                while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
                    $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
                    $cart_total_price+($cart_total_price * 0.09975)+($cart_total_price * 0.05);
                    $cart_QST += $cart_total_price * 0.09975;
                    $cart_GST += $cart_total_price * 0.05;
                    $cart_grand_total += $cart_total_price + $cart_QST + $cart_GST;
        ?>
        <?php 
                }
            }
        ?>
        
        <div class="price">
            <span>QST: $<?= round($cart_QST, 2) ?> </span><br>
            <span>GST: $<?= round($cart_GST, 2) ?></span><br>
            <span>Total price: $<?= round($cart_grand_total, 2); ?></span><br>
        </div>
        
        <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="place order">
        
        </form>
        
    </section>

    <?php 
    if(isset($_POST['order'])){
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $method = $_POST['method'];
        $expiryDate = $_POST['date'];
        $address = 'No. '. $_POST['street'] .' '. $_POST['city'] .' '. $_POST['state'] .' '. $_POST['country'] .' - '. $_POST['postal_code'];
        $placed_on = date('d-M-Y');
    
        $cart_total = 0;
        $cart_products[] = '';
    
        $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $cart_query->execute([$user_id]);
        if($cart_query->rowCount() > 0){
            while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
                $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
                $sub_total = ($cart_item['price'] * $cart_item['quantity']);
                $cart_total += $sub_total;
            };
        };
        $total_products = implode(' ', $cart_products);
        $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND email = ? AND method = ? AND expiry_date = ? AND address = ? AND total_products = ? AND total_price = ?");
        $order_query->execute([$name, $email, $method, $expiryDate, $address, $total_products, $cart_total]);
    
        if($cart_total == 0){
                echo '<script>
                alert("Your cart is empty now !");
                </script>';
            }elseif($order_query->rowCount() > 0){
                echo '<script>
                alert("Order placed already !");
                </script>';
            }else{
                $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, email, method, expiry_date, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
                $insert_order->execute([$user_id, $name, $email, $method, $expiryDate, $address, $total_products, $cart_grand_total, $placed_on]);
                $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
                $delete_cart->execute([$user_id]);
                echo '<script>
                alert("Thanks for your purchase, your order has been saved !");
                window.location.href = "orders.php";
                </script>';
            }   
    
    }
    
    ?>


    <?php require 'footer.php'?>
</body>
</html>