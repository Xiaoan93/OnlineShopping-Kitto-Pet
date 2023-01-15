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
 

if(isset($_POST['update_profile'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $old_pass = $_POST['old_pass'];
    $update_pass = $_POST['update_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if(!empty($_POST['update_pass']) && !empty($_POST['new_pass']) && !empty($_POST['confirm_pass'])){
        if($update_pass != $old_pass){
            echo '<script>
            alert("Old password not matched!");
            </script>';
        }elseif($new_pass != $confirm_pass){
            echo '<script>
            alert("Confirm password not matched!");
            </script>';
        }else{
            $update_profile = $conn->prepare("update users set name = ?, email=?, password=? where id =?");
            $update_profile->execute([$name, $email, $confirm_pass, $user_id]);
            echo '<script>
            alert("User Information updated successfully!");
            </script>';
        }
    }else{
        echo '<script>
            alert("Please fill your update information!");
            </script>';
    }
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="./images/icon-cat.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update User Profile</title>
    <style>
        body{
            font-family:Verdana, Geneva, Tahoma, sans-serif;
            background: url("./images/backgroundImg.jpg");
        }
        .title{
            text-align: center;
            margin-top: 3rem;
            margin-bottom: 3rem;
            text-transform: uppercase;
            font-size: 2rem;
        }
        
        .update-profile form{
            width: 60%;
            margin: 10px auto;
            background-color: whitesmoke;
            box-shadow:0 .5rem 1rem rgba(0,0,0,.2);
            border-radius: 12px;
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
        }


        .update-profile form .inputBox span{
            display: block;
            padding-top: 1rem;
            font-size: 1rem;
            color: #666;
        }

        .update-profile form .inputBox .box{
            width: 30%;
            padding: .5rem .8rem;
            font-size: 1rem;
            color: #333;
            border: 2px solid #333;
            border-radius: 8px;
        }
        .flex-btn .btn-primary{
            display: block;
            border: none;
            width: 20%;
            margin: 2rem auto;
            cursor: pointer;
            color: white;
        }
        .flex-btn .option-btn{
            text-align: center;
            text-decoration: none;
            display: block;
            border: none;
            width: 20%;
            height: 42px;
            border-radius: 5px;
            margin: 2rem auto;
            cursor: pointer;
            color: white;
        }
        @media(max-width:1380px){
            .update-profile form .inputBox .box{
                width: 60%;
                margin: 0 auto;
                display: block;
            }
            .flex-btn .btn-primary{
                display: block;
                border: none;
                width: 40%;
                margin: 20px auto;
                cursor: pointer;
                color: white;
                }
            .flex-btn .option-btn{
                text-align: center;
                text-decoration: none;
                display: block;
                border: none;
                width: 40%;
                height: 42px;
                border-radius: 5px;
                margin: 20px auto;
                cursor: pointer;
                color: white;
            }

        }
        @media(max-width:910px){
            .update-profile form .inputBox .box{
                width: 60%;
                margin: 0 auto;
                display: block;
            }
            .flex-btn .btn-primary{
                display: block;
                border: none;
                width: 40%;
                margin: 20px auto;
                cursor: pointer;
                color: white;
                }
            .flex-btn .option-btn{
                text-align: center;
                text-decoration: none;
                display: block;
                border: none;
                width: 40%;
                height: 42px;
                border-radius: 5px;
                margin: 20px auto;
                cursor: pointer;
                color: white;
            }
            .profile{
                margin-left: 2rem;
                position: absolute;
                top: 100%; right: 15rem;
                border: 2px solid #ddd;
                text-align: center;
                padding: 2rem 2.5rem;
                background-color: whitesmoke;
                width: 25%;
                display: none;
                animation: fadeIn .2s linear;
            }
        }
        @media(max-width:610px){
            .update-profile form .inputBox span{
                display: block;
                padding-top: 0.5rem;
                font-size: 1rem;
                color: #666;
            }
            .flex-btn .btn-primary{
                display: block;
                border: none;
                width: 60%;
                margin: 20px auto;
                cursor: pointer;
                color: white;
                font-size: 0.6rem;
                height: 40px;
                text-overflow: wordwrap;
            }
            .update-profile form .inputBox .box{
                width: 100%;
                padding: .5rem .8rem;
                font-size: 1rem;
                color: #333;
                border: 2px solid #333;
                border-radius: 8px;
            }

            .flex-btn .option-btn{
                text-align: center;
                text-decoration: none;
                border: none;
                width: 60%;
                height: 30px;
                border-radius: 5px;
                margin: 10px auto;
                cursor: pointer;
                color: white;
                font-size: 0.6rem;
            }
        }
        @media(max-width:450px){
            .update-profile form{
                width: 90%;
                margin: 0 auto;
                background-color: whitesmoke;
                box-shadow:0 .5rem 1rem rgba(0,0,0,.2);
                border-radius: 12px;
                border: 1px solid #ddd;
                text-align: center;
                padding: 3rem;
            }
            .flex-btn .btn-primary{
                display: block;
                border: none;
                width: 70%;
                margin: 20px auto;
                cursor: pointer;
                color: white;
                font-size: 0.8rem;
                height: 40px;
            }
            .flex-btn .option-btn{
                text-align: center;
                text-decoration: none;
                border: none;
                width: 70%;
                height: 30px;
                border-radius: 5px;
                margin: 10px auto;
                cursor: pointer;
                color: white;
                font-size: 0.8rem;
            }
            
        }
       
        


    </style>
</head>
<body>
    <?php include 'login_header.php';?>
    <section class="update-profile">
        <h1 class="title">Update Profile</h1>
        <form action="" method="POST">
            <div class="flex">
                <div class="inputBox">
                    <span>Name: </span>
                    <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" class="box">
                    <span>Email: </span>
                    <input type="text" name="email" value="<?= $fetch_profile['email']; ?>" class="box">
                </div>
                <div class="inputBox">
                    <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
                    <span>old password :</span>
                    <input type="password" name="update_pass" class="box">
                    <span>new password :</span>
                    <input type="password" name="new_pass" class="box">
                    <span>confirm password :</span>
                    <input type="password" name="confirm_pass" class="box">
                </div>
            </div>
            <div class="flex-btn">
                <button type="submit" class="btn btn-primary" name="update_profile" value="Login">Update Profile</button>
                <a href="login_home.php" class="option-btn btn-warning">Go back</a>
                
            </div>
        </form>
        
    </section>
    <?php include 'footer.php'?>
</body>
</html>