<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>header</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .header{
            background: rgb(233, 233, 233);
            position: sticky;
            top:0; left: 0; right: 0;
            z-index: 1000;
            height: 100px;
            border-bottom: 1px solid rgb(83, 83, 83);
        }

        .header .flex{
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .header .logo{
            display: flex;
            margin-left: 3%;

        }
        .header #logo-img{
            width: 60%;
            margin: auto 5px;
        }
        .header .logo span{
            margin:auto 0px;
            font-size: 40px;
            color: rgb(175, 11, 11);
            font-weight: 800;
            margin-left: -25px;
        }

        .navbar ul{
            margin: 40px 30px;
            margin-left: 100px;
            /* background-color: #ddd; */
            /* width: 100%; */
        }

        .navbar ul li{
            list-style: none;
            display: inline-block;
            text-decoration: none;
            margin: auto 10px;
        }
        .navbar ul li a{
            text-decoration: none;
            color: rgb(114, 114, 114);
            transition: all 0.3s ease;
            text-transform: uppercase;
        }
        .navbar ul li a:hover{
            border-bottom: 3px solid rgb(74, 74, 74);
        }

        .icons{
            display: inline-block;
            font-size: 1.5rem;
            
        }

        .icons>*:hover{
            color: rgb(175, 11, 11);
        }

        .header .flex .icons >*{
            cursor: pointer;
            margin-left: 1.5rem;
            transition: all 0.3s ease;
        }

        .btn,
        .delete-btn{
            display: block;
            width: 100%;
            border: 1px solid none;
            border-radius: 5px;
            padding: 10px 15px;
            margin-top: 1rem;
            font-size: 1rem;
            text-transform: capitalize;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            color: while;
            /* white-space: nowrap; */
        }

        .btn{
            background-color: rgb(15, 129, 250);
            transition: all 0.8s ease;
        }
        .delete-btn{
            background-color: rgb(185, 14, 14);
            transition: all 0.8s ease;
        }

        .btn:hover{
            background-color: rgb(11, 83, 161);
        }

        .delete-btn:hover{
            background-color: rgb(132, 12, 12);
        }

        #menu-btn{
            display: none;
        }

        @keyframes fadeIn {
            0%{
                transform: translateY(-1rem);
            }
        }

        .profile{
            margin-left: 20px;
            position: absolute;
            top: 100%; right: 20rem;
            border: 2px solid #ddd;
            text-align: center;
            padding: 15px 20px;
            background-color: whitesmoke;
            width: 15%;
            display: none;
            animation: fadeIn .2s linear;
        }

        .profile.active{
            display: inline-block;
        }

        .profile p{
            padding: .5rem 0;
            font-size: 1.5rem;
            color: rgb(78, 78, 78);
        }
        

        @media(max-width:930px){
            #menu-btn{
                display: inline-block;
                transition: .2s linear;
            }
            .header{
                height: 85px;
            }
            .header .flex .navbar{
                border: 2px solid rgb(114, 114, 114);
                z-index: 1000;
                background-color: whitesmoke;
                position: absolute;
                top: 99%; left: 0; right: 0;
                color: rgb(114, 114, 114);
                transition: .2s linear;
                clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
            }

            .header .flex .navbar.active{
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }

            .navbar ul{
                margin: auto 30%;
                text-align: center;
            }

            .navbar ul li a:hover{
                border-bottom: none;
                
            }

            .navbar ul li{
                display: block;
                margin: 1.5rem;
                width: 100%;
                margin-left: 0;
                
            }
            .header .flex .navbar ul li:hover{
                background-color: rgb(167, 167, 167);
            }

            .icons{
                margin-left: 5rem;
            }

            .update-profile form .flex .inputBox{
                width: 100%;

            }
        }
        @media(max-width:1335px){
            .profile{
                margin-left: 20px;
                position: absolute;
                top: 100%; right: 15rem;
                border: 2px solid #ddd;
                text-align: center;
                padding: 15px 20px;
                background-color: whitesmoke;
                width: 15%;
                display: none;
                animation: fadeIn .2s linear;
            }
        }
        @media(max-width:830px){
            .profile{
                margin-left: 10px;
                position: absolute;
                top: 100%; right: 10rem;
                border: 2px solid #ddd;
                text-align: center;
                padding: 10px 15px;
                background-color: whitesmoke;
                width: 20%;
                display: none;
                animation: fadeIn .2s linear;
            }
        }

        @media(max-width:798px){
            .profile{
                margin-left: 10px;
                position: absolute;
                top: 100%; right: 10rem;
                border: 2px solid #ddd;
                text-align: center;
                padding: 10px 15px;
                background-color: whitesmoke;
                width: 20%;
                display: none;
                animation: fadeIn .2s linear;
            }
        }

        @media(max-width:590px){
            .profile{
                margin-left: 10px;
                position: absolute;
                top: 100%; right: -10rem;
                border: 2px solid #ddd;
                text-align: center;
                padding: 12px 18px;
                background-color: whitesmoke;
                width: 25%;
                display: none;
                animation: fadeIn .2s linear;
            }
        }

        @media(max-width:590px){
            .profile{
                margin-left: 10px;
                position: absolute;
                top: 100%; right: 10rem;
                border: 2px solid #ddd;
                text-align: center;
                padding: 12px 18px;
                background-color: whitesmoke;
                width: 30%;
                display: none;
                animation: fadeIn .2s linear;
            }
        }

        @media(max-width:444px){
            .profile{
                margin-left: 8px;
                position: absolute;
                top: 100%; right: 10rem;
                border: 2px solid #ddd;
                text-align: center;
                padding: 10px 25px;
                background-color: whitesmoke;
                width: 40%;
                display: none;
                animation: fadeIn .2s linear;
            }
        }
    
        @media(max-width:425px){
            .icons{
                margin-left: 0.2rem;
            }
            .navbar ul{
                margin: auto 10%;
                text-align: center;
            }
        }

        @media(max-width:390px){
            
        }
        
    </style>
</head>

    <header class="header">
        <div class="flex">
            <div class="logo">
                <a href="login.php"><img src="./images/logo-cat.png" alt="logo" id="logo-img"></a><span>Kitto</span>
            </div>
        </div>
    </header>

<script>
    let navbar = document.querySelector('.header .flex .navbar');
    document.querySelector('#menu-btn').onclick =()=>{
        navbar.classList.toggle('active');
    }


    window.onscroll=()=>{
        navbar.classList.remove('active');

    }
</script>
</html>