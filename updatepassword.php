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
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            text-align: center;
            font-family: 'Red Hat Display', sans-serif;
            background:  url("bg.jpg") no-repeat fixed center ;
            /* background-image: linear-gradient(60deg, rgb(0, 26, 20),rgb(0, 128, 98)); */
        }
        th,td{
            padding-top: 30px;
            border-spacing: 30px;
        }
    
        .header{
            font-size: 2rem;
            font-weight: bolder;
        }
        table{
           transform: translate(0,-60px);
        }
        table input{
            padding: 0.5rem 20px;
            font-size: 15px;
            text-align: center;
            border: none;
            outline: none;
            border-radius: 15px;
        }
        table input:hover{
            background-color: rgb(64,64,64);
             }
        table label{
            font-size: 20px;
        }
        .main{
            width: max-content;
            height: max-content;
            border-radius: 20px;
            border-color: grey;
            border-width: 2px;
            background-color: rgba(64,64,64,0.5);
            margin: 0 auto;
        }
        .button{
            padding: 7px 50px;
            font-family:  'Red Hat Display', sans-serif;
            font-weight: bolder;
            font-size: 1rem;
            border-radius: 1rem;
            border: none;
            outline: none;
            background: linear-gradient(to bottom left, #000099 0%, #3333ff 100%);
            margin-top: 20px;
        }
        .button:hover{
            background-color: #003327;
            color: whitesmoke;
        }
        .footer p,a{
            color: black;
            margin-left: 10px;
            font-size: 20px;
            font-weight:500;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reset password</h1>
    </div>
   <p><?php 
        if(isset($_SESSION['passing'])){
            echo $_SESSION['passing']; 
        }else{
            echo $_SESSION['passing']=" ";
        }?></p>
    <div class="main">
        <form action="" method="post">
            <table>
            <tr><th><label for="">New Password</label></th>
            <td><input type="password" name="password" placeholder="Nem Password" required></td></tr><br>
            <tr><th><label for="">Confirm Password</label></th>
            <td><input type="password" name="cpassword" placeholder="Confirm Password" required></td></tr><br>
            </table>
            <input type="submit" value="Update password" name="submit" class="button">
        </form>
    </div>
    <?php
        include 'connect.php';
        $selectquery="select * from contacts";
        $query=mysqli_query($connect,$selectquery);

        while($result=mysqli_fetch_array($query)){
            // echo $result['username']."<br>";
        }
        $nums=mysqli_num_rows($query);
        // echo $nums;
    
    if(isset($_POST['submit'])){
        if(isset($_GET('token'))){
            $token=$_GET['token'];
        $password=mysqli_real_escape_string($connect,$_POST['password']);
        $cpassword=mysqli_real_escape_string($connect,$_POST['cpassword']);

        $pass=password_hash($password,PASSWORD_BCRYPT);
        $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

            if($password === $cpassword){
                $updatequery="update contacts set password='$pass' where token='$token'";
                $iquery=mysqli_query($connect,$updatequery);
                if($iquery){
                    $_SESSION['msg']="your password has been updated";
                    header(('location:login.php'));
                }else{
                    $_SESSION['passing']="your password is not updated.";
                    header('location:updatepassword.php');
                }
        }else{
            $_SESSION['passing']="your password is not updated.";
        }
    }else{
        $_SESSION['passing']="token not found.";
    }
    }
    
    ?>
</body>
</html>