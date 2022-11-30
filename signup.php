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
        <h1>login form</h1>
    </div>
   
    <div class="main">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
            <table>
            <tr><th><label for="">Username</label></th>
            <td><input type="email" name="username" placeholder="Enter username" required></td></tr><br>
            <tr><th><label for="">fullname</label></th>
            <td><input type="text" name="fullname" placeholder="Enter fullname" required></td></tr><br>
            <tr><th><label for="">Phone number</label></th>
            <td><input type="text" name="phone" placeholder="Mobile number" required></td></tr><br>
            <tr><th><label for="">Password</label></th>
            <td><input type="password" name="password" placeholder="Password" required></td></tr><br>
            <tr><th><label for="">Confirm Password</label></th>
            <td><input type="password" name="cpassword" placeholder="Confirm Password" required></td></tr><br>
            </table>
            <input type="submit" value="Sign up" name="submit" class="button">
            <p> <a href="updatemail.php">forget password?</a></p>
        </form>
    </div>
    <div class="footer">
        <p>already registered <span><a href="login.php">login</a></span></p>
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
        $fullname=mysqli_real_escape_string($connect,$_POST['fullname']);
        $phone=mysqli_real_escape_string($connect,$_POST['phone']);
        $password=mysqli_real_escape_string($connect,$_POST['password']);
        $cpassword=mysqli_real_escape_string($connect,$_POST['cpassword']);
        $token=mysqli_real_escape_string($connect,$_POST['token']);
        $status=mysqli_real_escape_string($connect,$_POST['status']);

        $pass=password_hash($password,PASSWORD_BCRYPT);
        $cpass=password_hash($cpassword,PASSWORD_BCRYPT);
        $token=bin2hex(random_bytes(15));

        $emailquery="select * from contacts where username='$username'";
        $query=mysqli_query($connect,$emailquery);

        $emailcount= mysqli_num_rows($query);
        if($emailcount>0){
            ?>
            <script>
                alert("email already exist!!");
            </script>
            <?php       
             }
             else
             {
            if($password === $cpassword){
                $insertquery="insert into contacts(username, fullname, phone, password, cpassword, token, status) values('$username', '$fullname', '$phone','$pass', '$cpass','$token','inactive')";
                $submitted= mysqli_query($connect,$insertquery);
                if($submitted){
                    $subject="Email Activation!";
                    $body="Hi $username. click here to activate your account. 
                    http://localhost/login_form/activate.php? token=$token";
                    $headers="From: rizwan97siddiqui@gmail.com";

                    if(mail($username,$subject,$body,$headers)){
                        $_SESSION['msg']="check your mail to activate your account $username";
                        header('location:login.php');
                    }else{
                        echo "email sending failed";
                    }
                }
            }else{
                ?>
                <script>
                    alert("password is not matching");
                </script>
                <?php            }
        }


    }
    ?>
</body>
</html>