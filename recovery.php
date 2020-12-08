<?php
require_once 'init.php';

$title = 'Password Recovery';
if(isset($_POST['email'])){
$email = $_POST['email'];
$user = FindUserByEmail($email);
        if(!$user){
            echo '<div class="alert alert-danger" role="alert">' . 'Your account not found' . '</div>';
        } else {
            $code = strtoupper(base64_encode(random_bytes(4)));
            
            
            $rp = sendEmail($user['Email'],'Recovery your account','Click this link to recovery your account http://localhost/doan/activepass.php?id=' .$user['Id'].'&code='.$code);
           
            if($rp == 1){
            UpdateCode($user['Email'],$code);
            header('Location:report.php');
            }else{
               header('Location:erro404notfound.php');
            }
        }
        
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Forgot password</title>
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
<body>
    <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="https://i.pinimg.com/564x/89/64/99/8964998576cfac440b3a14df748fc670.jpg" />
                <p id="profile-name" class="profile-name-card"> Forgot password?</p>
                <form class="form-signin" action="recovery.php" method="POST">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <sub>Please provide your email  to retrieve your password </sub>
                    <br/>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Send</button>
                </form>
     
            </div>
    </div>
</body>
</html>