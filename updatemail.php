<?php

session_start();

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
       <div class="main">
        <h2>Login here</h2>
        <div>
      <p><?php 
        // if(isset($_SESSION['msg'])){
        //     echo($_SESSION)['msg'];
        // }else{
            echo $_SESSION['msg']= "for updating your password please check your email" ;
        // }
        // echo($_SESSION)['msg'];
       ?></p> 
    </div>
    <div class="table">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
        <table>
        <tr><input type="email" name="username" placeholder="enter email" class="input"></tr><br>
        </table>
        <input class="button" type="submit" name="submit" value="Login"> <br>
        </form>
    </div>
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
        $username= mysqli_real_escape_string($connect,$_POST['username']) ;

        $emailquery="select * from contacts where username='$username'";
        $query=mysqli_query($connect,$emailquery);

        $emailcount= mysqli_num_rows($query);
        if($emailcount>0){
                    $userdata= mysqli_fetch_array($query);
                    $fullname=$userdata['fullname'];
                    $token=$userdata['token'];
                    $subject="Email Activation!";
                    $body="Hi $fullname. click here to to reset your password. 
                    http://localhost/login_form/updatepassword.php? token=$token";
                    $headers="From: rizwan97siddiqui@gmail.com";

                    if(mail($username,$subject,$body,$headers)){
                        $_SESSION['msg']="check your mail to reset your password  $username";
                        header('location:login.php');
                    }else{
                        echo "email sending failed";
                    
                }
            }else{
            echo "no email found.";  
            }
        }


    
    ?>
</body>
</html>