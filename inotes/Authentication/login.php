<?php
include '../dbconfig.php';
if(isset($_POST['login-inp']))
{
    $email= mysqli_real_escape_string($conn,$_POST['email-inp']);
    $pwd=mysqli_real_escape_string($conn,$_POST['pwd']) ;

    if($email!==''||$pwd!=='')
    {
        $sql_query="select count(*) as usercount from users where email='".$email."';";
        $result= mysqli_query($conn,$sql_query);
        $row=mysqli_fetch_array($result); 
        $count=$row['usercount'];

        if($count>0)
        {
            $sql_query="select username as username, email as useremail, password as pwdhsh from users where email='".$email."';";
            $result= mysqli_query($conn,$sql_query);
            $row=mysqli_fetch_array($result); 

            if(password_verify($pwd,$row['pwdhsh'])==true)
            {
                session_start(); 
                $_SESSION['username']=$row['username'];
                $_SESSION['useremail']=$row['useremail'];

                 header('Location:../index.php');
            }
            elseif($row['pwdhsh']==$pwd)
            {
                session_start(); 
                $_SESSION['username']=$row['username'];
                $_SESSION['useremail']=$row['useremail'];

                 header('Location:../index.php');
            }
            else
            {
?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Sorry</strong> Your password does not exist.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php
            }

            
        }
        
        else
        {
?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Sorry</strong> Username or Password does not exist.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php
        }
    }
    else
    {
?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>All fields are mendatory</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php
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
            padding-bottom:15px;

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
        <h1>Login Page</h1>
        </div>
       <form method="post" action="">

            <input type="email" id="email-inp" name="email-inp" placeholder="Enter Your Email"/>
            <input type="password" id="pwd" name="pwd" placeholder="Enter Password"/>

            <button type="Submit" name="login-inp">LOGIN</button>
       </form>
        <div id="down">
            <a href="../Authentication/register.php">Crete a new Account/sign up</a>
        </div>
    </section>
    
</body>
</html>