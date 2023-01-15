<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_quantity_query->execute([$update_value, $update_id]);
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$delete_id]);
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    header('location:cart.php');
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
    <title>Cart Page</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
        body{
            background: url("./images/backgroundImg.jpg");
        }
        
        h2{
            white-space: nowrap;
            max-width: 100%;
            margin: 30px 40%;
            font-weight: bold;
        }

        
        .container table{
            text-align: center;
            border: .5px solid black;
            margin: 20px auto;
        }
        .container table #images{
            width: 50%;
            height: 50%;
        }
        .container table thead th,
        .container table tbody th {
            padding: 10px;
            font-size: 20px;
            background-color: #ddd;
            border: .5px solid black;

        }
        .container table tr td{
            padding: 1.5rem;
            font-size: 15px;
            color: black;
            border: .5px solid black;
        }
        .container table tr:nth-child(even){
            background: rgb(236, 236, 236);
        }
        .container table input[type="number"]{
            width: 80%;
            padding: 5px 10px;
        }
        .container table input[type="submit"]{
            width: auto;
            padding: 3px 7px;
            background-color: rgb(226, 149, 5);
            color: #eee;
            transition: all .5s ease;
            border-radius: 4px;
            border: none;
            margin-top: 10px;
        }
        .container table input[type="submit"]:hover{
            background-color: rgb(190, 125, 5);
        }
        .container table .table-bootom{
            border: .5px solid black;

        }

        .container .table-bottom input[type="submit"]{
            border: none;
            padding: 6px 8px;
        }
        .container .table-bottom input[type="submit"]:hover{
            background-color: rgb(190, 125, 5);
        }
        .delete-btn{
            color: #eee;
        }

        .checkout{
            display: block;
            width: 15%;
            margin: 20px auto;
        }

        .checkout .btn{
            text-decoration: none;
            border: none;
            background-color: rgb(15, 121, 208);
            color: #eee;
            padding: 10px 35px;
            border-radius: 7px;
            margin: 0 auto;
            width: 150px;
            
        }

        @media (max-width:1200px){

            .shopping-cart{
                overflow-x: scroll;
            }

            .shopping-cart table{
                width: 90rem;
            }

            .shopping-cart h2{
                text-align: left;
            }
        }
        @media (max-width:700px){
            .checkout{
                display: block;
                width: 35%;
                margin: 5px auto;
            }
        }
        @media (max-width:600px){
            h2{
                white-space: nowrap;
                max-width: 100%;
                margin: 30px 23%;
            }
        }
    </style>
</head>
<body>
    <?php include 'login_header.php'; ?>
    <h2>Your shopping cart:</h2>
    <section class="shopping-cart">
    <button
        type="button"
        class="btn-floating"
        id="btn-back-to-top"
        >
        <i class="fa fa-arrow-up"></i>
    </button>
        
        <div class="container">
            
            <table>
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>

                <tbody>
                <?php
                    $grand_total = 0;
                    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $select_cart->execute([$user_id]);
                    if($select_cart->rowCount() > 0){
                        while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ 
                ?>
                
                <tr>
                
                    <td><img src="<?= $fetch_cart['image']; ?>" alt="" id="images"></td>
                    <td><div class="name"><?= $fetch_cart['name']; ?></div></td>
                    <td><div class="details"><?= $fetch_cart['details']; ?></div></td>
                    <td><div class="price">$<span><?= $fetch_cart['price']; ?></span></div></td>
                    <td>
                    <form action="" method="POST">
                        <input type="hidden" name="update_quantity_id" value="<?= $fetch_cart['id']; ?>">
                        <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" class="qty" name="update_quantity">
                        <input type="submit" value="update" name="update_btn" class="option-btn">
                    </form>
                    </td>
                    <td><div class="sub-total">Sub total <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span></div></td>
                    <td><a href="cart.php?delete=<?= $fetch_cart['id']; ?>" onclick="return confirm('Are you sure to remove this item from your cart ?')" class="delete-btn" name="delete"><i class="fa fa-trash">Remove</i></a></td>
                </tr>
                
                <?php
                $grand_total += $sub_total;
                        }
                    
                }?> 
                
                <tr class="table-bottom">
                    <td><a href="shop.php"><input type="submit" value="Continue Shopping" class="continue"></a></td>
                    <td colspan="4">Grand total</td>
                    <td>$<?php echo $grand_total;?></td>
                    <td><a href="cart.php?delete_all"><input type="submit" value="Delete All" class="deleteWishlist" name="delete_all" onclick="return confirm('Are you sure to delete all items from wishlist?');" <?= ($grand_total > 0)?'':'disabled'; ?>></a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
    <br><br>
    <div class="checkout">
        <a href="checkout.php" class="btn <?= ($grand_total > 0)?'':'disabled'; ?>">Checkout</a>
    </div>
    
    <?php require 'footer.php'?>
</body>
<script src="./scroll.js"></script>
</html>