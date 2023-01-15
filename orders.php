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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Order Page</title>
    <style>
         html {
            scroll-behavior: smooth;
        }
        body{
            background: url("./images/backgroundImg.jpg");
        }
        .placed-orders .title{
            width: 50%;
            margin: 4% 41%;
            font-weight: bold;
        }
        h2{
            font-size: 2.5rem;
        }
        
        .container .empty{
            border: 2px solid #eee;
            width: 40%;
            margin: 20px auto;
            text-transform: capitalize;
            padding: 40px 40px;
            font-size: 1.5rem;
            background-color: #eee;
            border-radius: 10px;
        }
        .container .box{
            text-transform: capitalize;
            border: 3px solid rgb(146, 143, 143);
            text-align: left;
            width: 70%;
            margin: 5% auto;
            padding: 15px 20px;
            
        }
        @media(max-width:780px){
            .placed-orders .title{
                width: 50%;
                margin: 4% 35%;
            }
        }

        @media(max-width:650px){
            .placed-orders .title{
                width: 50%;
                margin: 4% 31%;
            }
        }
        @media(max-width:494px){
            .placed-orders .title{
                width: 70%;
                margin: 4% 20%;
                
            }
            .box-container .empty{
                border: 2px solid #eee;
                width: 70%;
                margin: 20px auto;
                text-transform: capitalize;
                padding: 40px 40px;
                font-size: 1.5rem;
                background-color: #eee;
            }
            .container .box{
                text-transform: capitalize;
                border: 3px solid rgb(146, 143, 143);
                text-align: left;
                width: 85%;
                margin: 5% auto;
                padding: 15px 20px;
                
            }
        }

    </style>
</head>
<body>
    <?php include 'login_header.php'; ?>
    <section class="placed-orders">
        <h2 class="title">Your Orders:</h2>
        <button
            type="button"
            class="btn-floating"
            id="btn-back-to-top"
            >
            <i class="fa fa-arrow-up"></i>
        </button>
        <div class="container">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if($select_orders->rowCount() > 0){
                while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
            ?>
            <div class="box">
                <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
                <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
                <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
                <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
                <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
                <p> your orders : <span><?= $fetch_orders['total_products']; ?></span> </p>
                <p> total price : <span>$<?= $fetch_orders['total_price']; ?></span> </p>
                <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
            </div>
            <?php
                }
            }else{
                echo '<p class="empty">Sorry, no orders placed yet!</p>';
            }
            ?>
        </div>
    </section>



    <?php require 'footer.php'?>
</body>
<script src="./scroll.js"></script>

</html>