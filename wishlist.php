<?php 
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    echo '<script>
        alert("Please login your account first !");
        window.location.href = "login.php";
        </script>';
};

if(isset($_POST['add_to_cart'])){
    $pid = $_POST['pid'];
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_details = $_POST['p_details'];
    $p_image = $_POST['p_image'];
    $p_qty = $_POST['p_qty'];


    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_numbers->execute([$p_name, $user_id]);

    if($check_cart_numbers->rowCount() > 0){
        echo '<script>
        alert("Already added to cart !");
        </script>';
    }else{

        $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist_numbers->execute([$p_name, $user_id]);

        if($check_wishlist_numbers->rowCount() > 0){
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
            $delete_wishlist->execute([$p_name, $user_id]);
        }

        $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, details, price, quantity, image) VALUES(?,?,?,?,?,?,?)");
        $insert_cart->execute([$user_id, $pid, $p_name, $p_details, $p_price, $p_qty, $p_image]);
        echo '<script>
        alert("You have been added to cart !");
        </script>';
    }
}

if(isset($_POST['delete'])){

    $delete_id = $_POST['pid'];
    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
    $delete_wishlist_item->execute([$delete_id]);
    header('location:wishlist.php');
 
 }

if(isset($_GET['delete_all'])){

    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
    $delete_wishlist_item->execute([$user_id]);
    header('location:wishlist.php');
 
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon-cat.png"/>
    <link rel="stylesheet" href="./shop.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Wishlist Page</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
        body{
            background: url("./images/backgroundImg.jpg");
        }

        .clear {
            clear: both;
        }
        .products .title{
            font-weight: bold;
            max-width: 10%;
            margin: 10px auto;
            font-size: 2rem;
        }
        form .option-btn{
            background-color: sandybrown;
        }
        form .option-btn:hover{
            background-color: rgb(192, 108, 35);
        }

        .wishlist-total{
            display: grid;
            width: 70%;
            margin: 10px auto;
            padding-top: 10px;
            text-align: center;
            border: 2px solid rgb(108, 107, 107);
        }
        .wishlist-total .deleteWishlist{
            padding: 10px;
            max-width: 30%;
            margin: 10px auto;
            border: none;
            margin-top: 1rem;
            color: white;
            border-radius: 7px;
            background-color: rgb(197, 7, 7);
        }
        .wishlist-total a{
            text-decoration: none;
        }
            

        .wishlist-total .continue{
            text-decoration: none;
            border: 1px solid sandybrown;
            border-radius: 7px;
            color: white;
            background-color: sandybrown;
            padding: 10px;
            
        }

        .product-container .empty{
            text-align: center;
            margin: 0 auto;
            text-transform: capitalize;
            font-weight: bold;
        }


        @media(max-device-width: 450px){
            .wishlist-total .deleteWishlist{
                padding: 10px;
                max-width: 40%;
                margin: 10px auto;
                border: none;
                margin-top: 1rem;
                color: white;
                border-radius: 7px;
                background-color: rgb(197, 7, 7);
            }

            .product-container .empty{
                text-align: center;
                margin: 0 auto;
                text-transform: capitalize;
            }
            .products .title{
                max-width: 30%;
                margin: 10px auto;
                font-size: 2rem;
            }
        }


        
    </style>
</head>
<body>

    <?php include 'login_header.php'; ?>
    
    <section class="products">
        <button
            type="button"
            class="btn-floating"
            id="btn-back-to-top"
            >
            <i class="fa fa-arrow-up"></i>
        </button>   

        <h2 class="title">Wishlist</h2>

        <div class="product-container">

            <?php
                $grand_total = 0;
                $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $select_wishlist->execute([$user_id]);
                if($select_wishlist->rowCount() > 0){
                    while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){ 
            ?>
            <form action="" class="box" method="POST">
                    <img src="<?= $fetch_wishlist['image']; ?>" alt="" id="images">
                    <div class="price">$<span><?= $fetch_wishlist['price']; ?></span></div>
                    <div class="name"><?= $fetch_wishlist['name']; ?></div>
                    <div class="name"><?= $fetch_wishlist['details']; ?></div>
                    <input type="hidden" name="pid" value="<?= $fetch_wishlist['id']; ?>">
                    <input type="hidden" name="p_name" value="<?= $fetch_wishlist['name']; ?>">
                    <input type="hidden" name="p_details" value="<?= $fetch_wishlist['details']; ?>">
                    <input type="hidden" name="p_price" value="<?= $fetch_wishlist['price']; ?>">
                    <input type="hidden" name="p_image" value="<?= $fetch_wishlist['image']; ?>">
                    <input type="number" min="1" value="1" name="p_qty" class="qty"><br>    
                    <input type="submit" value="Delete" class="option-btn" name="delete" onclick="return confirm('delete this from wishlist?');">
                    <input type="submit" value="Add to cart" class="btn" name="add_to_cart">
                </form>
            <?php

                $grand_total += $fetch_wishlist['price'] ;
                }
            }else{
                echo '<p class="empty">Oops! Your wishlist is empty now!</p>';
            }
            ?>
        </div>
        <div class="wishlist-total">
            <p>Grand total : <span>$<?= $grand_total; ?></span></p>
            <a href="shop.php"><input type="submit" value="Continue Shopping" class="continue"></a>
            <a href="wishlist.php?delete_all"><input type="submit" value="Delete All" class="deleteWishlist" onclick="return confirm('Are you sure to delete all items from wishlist?');" <?= ($grand_total > 0)?'':'disabled'; ?>></a>
        </div>
    </section>
    <div class="clear"></div>
    <?php require 'footer.php'?>
    

</body>
<script src="./scroll.js"></script>
</html>
    