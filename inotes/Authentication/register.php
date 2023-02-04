<?php
include '../dbconfig.php';
if(isset($_POST['register-inp']))
{
    $name=mysqli_real_escape_string($conn,$_POST['name-inp']);
    $email= mysqli_real_escape_string($conn,$_POST['email-inp']);
    $pwd=mysqli_real_escape_string($conn,$_POST['pwd']) ;
    $cpwd=mysqli_real_escape_string($conn,$_POST['cpwd']) ;

    if($name!=='' && $email!==''&& $pwd!=='' && $cpwd!=='')
    {
        if($pwd===$cpwd)
        {
            $cipher_pwd=password_hash($pwd,PASSWORD_ARGON2I);
            $sql_query="insert into users (username,email,password) values('".$name."','".$email."','".$cipher_pwd."');";
            $result= mysqli_query($conn,$sql_query);
            if($result)
            {
                header('location:login.php');
            }
            else
            {
                echo "kindly try with another email";
            }
        }
        
        else
        {
            echo "password did not match";
        }
    }
    else
    {
        echo "All fields are mendatory";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <style>
        *
        {
            margin: 0;
            padding: 0;
        }
        #main
        {
            border: 2px solid black;
            border-radius: 15px;
            height: 50%;
            width: 50%;
            transform: translate(50%,50%);
            text-align: center;

        }
        #title
        {
          
            padding: 20px ;
            font-size: 23px;
            background-color: cornflowerblue;
            color: white;
            border-radius: 13px 13px 0px 0px;
            height: 40px;
        }
        form
        {
            padding: 40px;
        }

        form input
        {
            display: block;
            width: 98%;
            font-size: 15px;
            text-align: center;
            padding: 8px;
            margin: 10px;
            border: 1px solid black;
        }
        form button
        {
            font-size: 14px;
           background-color: cornflowerblue;
           color: white;
           padding: 5px;
           margin: 10px;
           border: 1px solid black;
            
        }
    </style>
</head>
<body>
    <section id=main>
        <div id=title>
        <h1>Create Your Account Here</h1>
        </div>
       <form method="post" action="">

            <input type="text" id="name-inp" name="name-inp" placeholder="Enter Your username"/>
            <input type="email" id="email-inp" name="email-inp" placeholder="Enter Your Email"/>
            <input type="password" id="pwd" name="pwd" placeholder="Create Password"/>
            <input type="password" id="cpwd" name="cpwd" placeholder="confirm Password"/>


            <button type="Submit" name="register-inp">Register</button>
  
       </form>
    </section>
</body>
</html>