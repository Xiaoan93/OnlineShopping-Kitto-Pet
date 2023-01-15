<?php
include_once 'config.php';
session_start();


try{
    if(isset($_POST['submit'])){
        if(!empty($_POST['name'])&&!empty($_POST['pass'])){
            $name = $_POST['name'];
            $pass =$_POST['pass'];
        
            $query = $conn->prepare("select * from users where name=? and password=?");
            $query->execute([$name, $pass]);
            $rowCount = $query->rowCount();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            if($rowCount>0){
                $_SESSION['user_id'] = $row['id'];
                header('location:login_home.php');
            }else{
                echo '<script>
                    alert("Invalid name or password !");
                    </script>';
            }
        }else{
            echo '<script>
                    alert("Please fill your account info !");
                    </script>';
        }
        
    }
}catch(PDOException $e){
    echo $e->getMessage();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./login.css">
    <link rel="shortcut icon" href="./images/icon-cat.png"/>
    <title>Login</title>
    <style>
        body{
            background: url("./images/backgroundImg.jpg");
        }
    </style>
</head>
<body>
    <?php require 'header.php' ?>
    <section class="container">
        <form action="" method="POST">
            <h3>Login</h3>
            <label>Name</label>
            <input type="text" id="box" name="name" class="form-control" require/>

            <label>Password</label>
            <input type="password" id="box" name="pass" class="form-control" require/>

            <input class="btn btn-primary" type="submit" name="submit" value="Login">

            <p>Do not have account yet? <a href="register.php">Register now</a></p>
        </form>
    </section>
    <?php include 'footer.php'?>
</body>

</html>