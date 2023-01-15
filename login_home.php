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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon-cat.png"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Home Page</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
        body{
            background: url("./images/backgroundImg.jpg");
        }

        *{
            margin: 0;
            padding: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            box-sizing: border-box;
        }
        .container{
            max-width: 70%;
            height: auto;
        }

        .advertise #adv{
            width: 90%;
            margin: 1rem 25%;
            box-shadow:0 .5rem 1rem rgba(0,0,0,.2);
        }

        .btn-primary{
            margin: 2rem auto;
            border: none;
            margin-left: 60%;
            max-width: 30%;
            color: white;
            height: 60px;
            font-size: 4rem;
        }

        .join a{
            text-decoration: none;
            font-size: 4rem;
        }
        .gallery{
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-column-gap: 2rem;
            grid-template-rows: 20rem;
            width: 100%;
            margin: 2rem 24%;
            transition: all .3s ease;
        }
        .gallery #galleryImg{
            box-shadow:0 .5rem 1rem rgba(0,0,0,.2);
            margin: .5rem auto;
        }
        .gallery p{
            text-align: center;
            margin-left: -35%;
        }
        
        .banner{
            width: 100%;
            margin: 10px 20%;
        }

        .mySlides{
            display: none;
        }

        .banner .slideshow-container{
            margin: 1% 80px;
            padding: 0;
        }
        .banner .slideshow-container img{
            border: 10px solid rgb(87, 86, 86);
        }

        .banner .description{
            text-align: center;
        }

        .fade{
            animation-name: fade;
            animation-duration: 1s;
        }

        @keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
        }

        #banner-image{
            height: 650px;
            display: block;
            width: 100%;
        }

        #btn-back-to-top {
            transition: .5s ease;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            border: none;
            border-radius: 50%;
            padding: 10px;
            background-color: orange;
            cursor: pointer;
        }

        #btn-back-to-top:hover{
            background-color: rgb(218, 143, 4);
        }


        @media (max-width:1390px){
            .gallery{
                margin-top: 3rem;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                grid-column-gap: 2rem;
                grid-template-rows: 20rem;
                width: 100%;
                margin-left: 20%;
                transition: all .3s ease;
            }   

        }
        @media (max-width:1190px){
            .gallery{
                margin-top: 3rem;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                grid-column-gap: 2rem;
                grid-template-rows: 20rem;
                width: 100%;
                margin-left: 18%;
                transition: all .3s ease;
            }  
        }
        @media (max-width:1035px){
            .gallery{
                margin-top: 3rem;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-column-gap: 2rem;
                grid-template-rows: 20rem;
                width: 100%;
                margin-left: 22%;
            }
            .banner .slideshow-container img{
                width: 150%;
                height: 150%;
                border: 10px solid rgb(87, 86, 86);
            }
            .banner{
                width: 100%;
                margin: 10px 5%;
            }
            .banner .description{
                text-align: center;
                width: 100%;
                margin: 10px 15%;
            }
        }
        @media (max-width:750px){
            .gallery{
                margin-top: 3rem;
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                grid-column-gap: 2rem;
                grid-template-rows: 20rem;
                width: 100%;
                margin-left: 25%;
                
            }
            
            .gallery #galleryImg{
                height: 200px;
                width: 230px;
            }

            .banner .slideshow-container img{
                width: 180%;
                height: 180%;
                border: 10px solid rgb(87, 86, 86);

            }
            .banner{
                width: 100%;
                margin: 10px -8px;
            }
            .banner .description{
                text-align: center;
                width: 100%;
                margin: 10px 25%;
            }
        }
        @media (max-width:690px){
            .btn-primary{
                margin: 2rem auto;
                border: none;
                margin-left: 40%;
                max-width: 60%;
                color: white;
                height: 40px;
                font-size: 4rem;
            }
        }
        @media (max-width:690px){
            .banner .slideshow-container img{
                width: 200%;
                height: 200%;
                border: 10px solid rgb(87, 86, 86);
            }
            .banner{
                width: 100%;
                margin: 10px -40px;
            }
            .banner .description{
                text-align: center;
                width: 100%;
                margin: 10px 35%;
            }
            .advertise #adv{
                width: 130%;
                margin: 1rem 5%;
                box-shadow:0 .5rem 1rem rgba(0,0,0,.2);
            }
        }
        @media (max-width:540px){
            .banner .slideshow-container img{
                width: 230%;
                height: 230%;
                border: 10px solid rgb(87, 86, 86);
            }
            .banner{
                width: 100%;
                margin: 10px -55px;
            }

        }
        @media (max-width:460px){
            .banner .slideshow-container img{
                width: 280%;
                height: 280%;
                border: 10px solid rgb(87, 86, 86);
            }
            .banner{
                width: 100%;
                margin: 10px -55px;
            }
            .banner .description{
                text-align: center;
                width: 100%;
                margin: 10px 40%;
            }
        }
        @media (max-width:400px){
            .banner .slideshow-container img{
                width: 330%;
                height: 330%;
                border: 10px solid rgb(87, 86, 86);
            }
            .banner{
                width: 100%;
                margin: 10px -70px;
            }
            .banner .description{
                text-align: center;
                width: 100%;
                margin: 10px 45%;
            }
        }


    </style>
</head>
<body>
    <?php include 'login_header.php'; ?>
    <div class="container">

        <div class="banner">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="./images/slide1.jpg" width="100%" height="100%">
                </div>
                <div class="mySlides fade">
                    <img src="./images/slide2.jpg" width="100%" height="100%">
                </div>
                <div class="mySlides fade">
                    <img src="./images/slide3.jpg" width="100%" height="100%" >
                </div>
                <div class="mySlides fade">
                    <img src="./images/slide4.jpg" width="100%" height="100%" >
                </div>
            </div>
            <div class="description">
                <h1>Welcome to Kitto online shop</h1>
                <br>
                <p>Our vision is to create an affordable, transparent, honest, and effective pet shop for our clients.</p>
                <br>
            </div>
        </div>

        <button
            type="button"
            class="btn-floating"
            id="btn-back-to-top"
            >

            <i class="fa fa-arrow-up"></i>
        </button>
        
        
       
        
        <div class="advertise">
            <img src="./images/ads.jpg" id="adv">
        </div>

        <div class="gallery">
            <div class="img1">
                <a href="shop.php"><img src="./images/gallery1.jpg" style="height: 230px; width: 260px;" id="galleryImg"></a>
                <p>Foods</p>
            </div>
            <div class="img2">
                <a href="shop.php"><img src="./images/gallery2.jpg" style="height: 230px; width: 260px;" id="galleryImg"></a>
                <p>Treats</p>
            </div>
            <div class="img3">
                <a href="shop.php"><img src="./images/gallery3.jpg" style="height: 230px; width: 260px;" id="galleryImg"></a>
                <p>Litters and cleanup</p>
            </div>
            <div class="img4">
                <a href="shop.php"><img src="./images/gallery4.jpg" style="height: 230px; width: 260px;" id="galleryImg"></a>
                <p>Cat trees</p>
            </div>
            <div class="img5">
                <a href="shop.php"><img src="./images/gallery5.jpg" style="height: 230px; width: 260px;" id="galleryImg"></a>
                <p>Toys</p>
            </div>
            <div class="img6">
                <a href="shop.php"><img src="./images/gallery6.jpg" style="height: 230px; width: 260px;" id="galleryImg"></a>
                <p>Care</p>
            </div>
        </div>
    </div>
    <?php require 'footer.php'?>
</body>
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        
        slides[slideIndex-1].style.display = "block";  
        setTimeout(showSlides, 3000); 
    }

    let mybutton = document.getElementById("btn-back-to-top");

    window.onscroll = function () {
    scrollFunction();
    };

    function scrollFunction() {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
    }
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    }
</script>
</html>