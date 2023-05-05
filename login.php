<?php 

require_once('config.php');
session_start();

if(isset($_POST['submit_form'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

   if(empty($username)){
        $error = "User name is Required!";
    }
    elseif(empty($password)){
        $error = "Password is Required!";
    }
    else{
        $password = SHA1($password);

        $loginCount = $connection->prepare("SELECT id,email,mobile,username,password,email_status,mobile_status FROM user_data WHERE username=? AND password=?");
        $loginCount->execute(array($username,$password));
        $userloginCount = $loginCount->rowCount();

        if($userloginCount == 1){
            $userData = $loginCount->fetch(PDO::FETCH_ASSOC);

            if($userData['mobile_status'] == 1 AND $userData['email_status'] == 1){
                $_SESSION['user'] = $userData;
                header('location:index.php');
            }
            else{
                $_SESSION['user_email'] = $userData['email'];
                $_SESSION['user_mobile'] = $userData['mobile'];

                $email_code = rand(111111,999999);
                $stm = $connection->prepare("UPDATE user_data SET email_code=? WHERE email=?");
                $stm->execute(array($email_code,$userData['email']));
                
                $message = "Your Verification Code is: ".$email_code;
                mail($userData['email'],"Email Verification",$message);

                header('location:verification.php');
            }
        }
        else{
            $error = "Username or Password is Wrong!";
        }

    }

}

if(isset($_SESSION['user'])){
    header('location:index.php');
}

?>


<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Agoni Store Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo.png">
    
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/style-user.css">
    <link rel="stylesheet" href="css/custom.css">
    
</head>

<body class="h-100">
    
   <!-- Page Preloder -->
   <div id="preloder">
        <div class="loader"></div>
    </div>

    
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.php"> <h2>Login</h2></a>
        
                                <?php if(isset($error)): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($success)): ?>
                                    <div class="alert alert-success">
                                        <?php echo $success; ?>
                                    </div>
                                <?php endif; ?>

                                <form action="" method="POST" class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input name="username" type="text" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button type="submit" name="submit_form" class="btn login-form__btn submit w-100 btn-hover">Login</button>
                                </form>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="registration.php" class="text-primary">Registration</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>





