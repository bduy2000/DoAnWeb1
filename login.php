
<?php
    require_once 'init.php';
    $title = 'Login';

    if(isset($_POST['Email']) && isset($_POST['Password'])){
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];

        $user = FindUserByEmail($Email);
        if(!$user){
            $error = 'Not found user';
        } else {
            if(!password_verify($Password,$user['Password'])){
                $error = 'Password incorrect';
            } else {
                if($user['Code']){
                    $error = 'Check email to active your account';
                }else{
                $_SESSION['userId'] = $user['Id'];
                header('Location:index.php');
                exit();
                }
            }
        }
    }

    
?>

<?php if (isset($error)): ?>
<div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
</div>
<?php endif; ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Login</title>
    <style>

        body {
            /* height: 100%; */
            background-image:url(https://i.pinimg.com/originals/f1/2c/46/f12c46485efa00faa633a74fdc6ea134.jpg);
          background-repeat: no-repeat;
          background-size: cover;
            position: relative;
            
        }
        
        .card-container.card {
            max-width: 350px;
            padding: 40px 40px;
        }
        
        .btn {
            font-weight: 700;
            height: 36px;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            cursor: default;
        }
        
        /*
         * Card component
         */
        .card {
            background-color: #F7F7F7;
            /* just in case there no content*/
            padding: 20px 25px 30px;
            margin: 0 auto 25px;
            margin-top: 50px;
            /* shadows and rounded borders */
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        
        .profile-img-card {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }
        
        /*
         * Form styles
         */
        .profile-name-card {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0 0;
            min-height: 1em;
        }
        
        .reauth-email {
            display: block;
            color: #404040;
            line-height: 2;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
        
        .form-signin #inputEmail,
        .form-signin #inputPassword {
            direction: ltr;
            height: 44px;
            font-size: 16px;
        }
        
        .form-signin input[type=email],
        .form-signin input[type=password],
        .form-signin input[type=text],
        .form-signin button {
            width: 100%;
            display: block;
            margin-bottom: 10px;
            z-index: 1;
            position: relative;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
        
        .form-signin .form-control:focus {
            border-color: rgb(104, 145, 162);
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
        }
        

        .btn.btn-signin {
            background-color:  #3ac5c9 ;
            color: white;
        }
        .btn.btn-signin:hover,
        .btn.btn-signin:active,
        .btn.btn-signin:focus {
            background-color:#205ed1;
        }
        
        .forgot-password {
            color: rgb(104, 145, 162);
        }
        
        .forgot-password:hover,
        .forgot-password:active,
        .forgot-password:focus{
            color:#3ac5c9;
        }
        </style>
</head>
<a type="button" href="index.php">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
</svg>
    </a>
<body>
    <div class="container">
   
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="https://i.pinimg.com/564x/89/64/99/8964998576cfac440b3a14df748fc670.jpg" />
                <p id="profile-name" class="profile-name-card"></p>
                <form class="form-signin" action="login.php" method="POST">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="email" name="Email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <input type="password" name="Password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">LOGIN</button>
                </form>
                <a href="recovery.php" class="forgot-password">
                    Forgot password?
                </a>
    </br>
    <a class="btn btn-lg btn-primary btn-block btn-signin" type= "button"href="register.php">CREATE  ACCOUNT</a>    
    
            </div>
    </div>
</body>
</html>

