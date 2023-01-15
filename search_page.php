<?php 
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(isset($message)){
    foreach($message as $message){
       echo '
       <div class="message">
          <span>'.$message.'</span>
          <i class="fa fa-times" onclick="this.parentElement.remove();"></i>
       </div>
       ';
    }
 }

if(!isset($user_id)){
    echo '<script>
        alert("Please login your account first !");
        window.location.href = "login.php";
        </script>';
};
if(isset($_POST['add_to_wishlist'])){
    $pid = $_POST['pid'];
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_details = $_POST['p_details'];
    $p_image = $_POST['p_image'];
    $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);
   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
    echo '<script>
        alert("Already added to wishlist !");
        </script>';
 }elseif($check_cart_numbers->rowCount() > 0){
    echo '<script>
        alert("Already added to shopping cart !");
        </script>';
 }else{
    $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, details, price, image) VALUES(?,?,?,?,?,?)");
    $insert_wishlist->execute([$user_id, $pid, $p_name, $p_details, $p_price, $p_image]);
    echo '<script>
        alert("You have been added to wishlist !");
        </script>';
 }
}

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
    <title>Shop Page</title>
    <style>
        body{
            background: url("./images/backgroundImg.jpg");
        }
       .input-group{
            display: inline-block;

        }
        .input-group .btn{
            margin: 15px auto;
            width: 10%;
        }

        .products .form-control{
            max-width: 45%;
            margin-right: 10px;
            margin: 0 auto;
            border: 0.3px solid rgb(50, 50, 50);
            
        }

        #search_box{
            width: 5%;
            height: 5vh;
        }

        .product-container .empty{
            text-align: center;
            margin: 0 auto;
            text-transform: capitalize;
        }

        @media (max-width:770px){
            .input-group .btn{
                width: auto;
                margin: 15px auto;
            }
        }
    </style>
</head>
<body>
    <?php include 'login_header.php'; ?>
    
    <div class="container">
        <div class="banner">
            <img src="./images/shop-banner.jpg" id="shop-bannerImg">
        </div>

        <section class="p-category">
            <a href="category.php?category=Food">Food</a>
            <a href="category.php?category=Accessories">Accessories</a>
            <a href="category.php?category=Treats">Treats</a>
            <a href="category.php?category=Care">Care</a>
        </section>

        <button
            type="button"
            class="btn-floating"
            id="btn-back-to-top"
            >
            <i class="fa fa-arrow-up"></i>
        </button>

        <section class="products">
            <h2 class="title">Latest product</h2>
            
            <div class="input-group">
                <form action="search_page.php" method="POST">
                    <div class="form-outline">
                        <input type="search" id="form1" name="search_bar" class="form-control" placeholder="Search your iteams ..."/>
                        <input type="submit" name="search_btn" value="search" class="btn">
                    </div>
                </form>
            </div>

            <div class="product-container">

            <?php 
            
            if(isset($_POST['search_btn'])){
                
                $search_bar = $_POST['search_bar'];
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_bar}%' OR category LIKE '%{$search_bar}%' OR details LIKE '%{$search_bar}%'");
                $select_products->execute();
                if($select_products->rowCount() > 0){
                   while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                ?>
                <form action="shop.php" class="box" method="POST">
                    <img src="<?= $fetch_products['image']; ?>" alt="" id="images">
                    <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
                    <div class="name"><?= $fetch_products['name']; ?></div>
                    <div class="details"><?= $fetch_products['details']; ?></div>
                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
                    <input type="hidden" name="p_details" value="<?= $fetch_products['details']; ?>">
                    <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
                    <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
                    <input type="number" min="1" value="1" name="p_qty" class="qty"><br>    
                    <input type="submit" value="Add to wishlist" class="option-btn" name="add_to_wishlist">
                    <input type="submit" value="Add to cart" class="btn" name="add_to_cart">
                </form>

                <?php
                   }
                }else{
                    echo '<p class="empty">no result found!</p>';
                }
                }?>
                </div>

                   
            
        </section>
    </div>
    
    <?php require 'footer.php'?>
</body>
<script src="./scroll.js"></script>
</html>