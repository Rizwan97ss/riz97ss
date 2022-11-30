<?php

session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Serif+Display&family=Gloria+Hallelujah&family=Montserrat:wght@300&family=Noto+Nastaliq+Urdu&family=Red+Hat+Display:wght@300&family=Roboto+Mono&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        body{
            text-align: center;
            font-family: 'Red Hat Display', sans-serif;
            background:  url("bg.jpg") no-repeat fixed center ;
        }
        .main{
            margin: 120px auto;
            width: max-content;
            height: max-content;
            border-radius: 20px;
            border-color: grey;
            border-width: 2px;
            background-color: #696969;
        }
        .table{
            padding: 30px 20px;
        }
        table{
            margin-bottom: 20px;
        }
        input{
            margin-bottom: 20px;
        }
        .input{
            padding: 7px 20px;
            border-radius: 13px;
            outline: none;
            border: none;
            text-align: center;
        }
        .button{
            border-radius: 15px;
            border: none;
            outline: none;
            padding: 10px 30px;
            background: linear-gradient(to bottom left, #000099 0%, #3333ff 100%);
            font-size: 17px;
        }
        .button:hover{
            background-color: #003327;
            color: whitesmoke;
        }
        h2{
            transform: translate(0,10px);
            color: whitesmoke;
        }

    </style>
</head>
<body>
    <?php
    include 'connect.php';

    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        $email_search="select * from contacts where username='$username'";
        //  and status='active";
        $query=mysqli_query($connect,$email_search);
        $email_count=mysqli_num_rows($query);

        if($email_count){
            $email_pass=mysqli_fetch_assoc($query);
            $db_pass=$email_pass['password'];
            $_SESSION['fullname']=$email_pass['fullname'];
            $pass_decode= password_verify($password,$db_pass);
            if($pass_decode){
            if(isset($_POST['remember'])){
                setcookie('emailcookie',$username,time()+86400);
                setcookie('passwordcookie',$password,time()+86400);
                header('location:home.php');
            }else{
                header('location:home.php');
            }
            }else{
                ?>
                <script>
                    alert("login not successful!!!");
                </script>
                <?php
            }
        }else{
            ?>
            <script>
                alert("Invalid email !");
            </script>
            <?php
        }
    }
    ?>
    <!-- <button class="logout"><a href="">Logout</a></button> -->
    <div class="main">
        <h2>Login here</h2>
        <div>
      <p><?php 
        // if(isset($_SESSION['msg'])){
        //     echo($_SESSION)['msg'];
        // }else{
            echo $_SESSION['msg']= "You are logged out. Please login again.";
        // }
        // echo($_SESSION)['msg'];
       ?></p> 
    </div>
    <div class="table">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
        <table>
        <tr><input type="email" name="username" placeholder="USERNAME" class="input" value="<?php if(isset($_COOKIE['emailcookie'])) {echo $_COOKIE['emailcookie'];} ?>"></tr><br>
        <tr><input type="password" name="password" placeholder="PASSWORD" class="input" value="<?php if(isset($_COOKIE['passwordcookie'])) {echo $_COOKIE['passwordcookie'];}?>"></tr><br>
        <p><input type="checkbox" name="remember" id="">remember me</p>
        </table>
        <input class="button" type="submit" name="submit" value="Login"> <br>
        </form>
    </div>
    </div>
</body>
</html>