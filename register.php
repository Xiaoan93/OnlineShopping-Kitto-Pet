<?php
include_once 'config.php';
session_start();

try{
    if(isset($_POST['submit'])){
        if(!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['pass'])&&!empty($_POST['cpass'])){
            $name = $_POST['name'];
            $email =$_POST['email'];
            $pass =$_POST['pass'];
            $cpass =$_POST['cpass'];
        
            $query = $conn->prepare("select * from users where email=? or name=?");
            $result = $query->execute([$email,$name]);
            $res= $query->fetchAll();

            if(sizeof($res)>0){
                echo '<script>
                    alert("Either name or email has been used !");
                    </script>';
            }else{
                if($pass != $cpass){
                    echo '<script>
                    alert("Password does not match !");
                    </script>';
                }else{
                    $insert = "insert into users(name, email, password) values('$name', '$email', '$pass')";
                    $conn->exec($insert);
                    echo '<script>
                    alert("You registered successfully !");
                    window.location.href = "login.php";
                    </script>';
                }
            }
        }else{
            echo '<script>
                    alert("Please fill your information !");
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
    <link rel="stylesheet" href="./register.css">
    <link rel="shortcut icon" href="./images/icon-cat.png"/>
    <title>Register</title>
    <style>
        body{
            background: url("./images/backgroundImg.jpg");
        }
    </style>
</head>
<body>
<?php include 'header.php'?>
    <section class="container">
        <form action="" method="POST">
            <h3>Register</h3>
            <label>Name</label>
            <input type="text" id="box" name="name" class="form-control" require/>
            <label>Email</label>
            <input type="email" id="box" name="email" class="form-control" require/>
            <label>Password</label>
            <input type="password" id="box" name="pass" class="form-control" require/>
            <label>Confirm Password</label>
            <input type="password" id="box" name="cpass" class="form-control" require/>
            <input class="btn btn-primary" type="submit" name="submit" value="Register">
            <span name = "message"></span>
            <p>Already have an account? <a href="login.php">login now</a></p>
        </form>
    </section>
    <?php include 'footer.php'?>
</body>

</html>