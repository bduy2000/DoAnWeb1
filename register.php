<?php
require_once 'init.php';

$title = 'Register';

if (isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['Category']) && isset($_POST['Address'])&& isset($_POST['ConfirmPassword'])&& isset($_POST['Address'])&& isset($_POST['Tel'])&& isset($_POST['Name'])) {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Category = $_POST['Category'];
    $Name = $_POST['Name'];
    $Address = $_POST['Address'];
    $Tel = $_POST['Tel']; 
    $confirmPassword = $_POST['ConfirmPassword'];
    $checkgmail = substr($Email, -10, 10);
    $realgmail = "@gmail.com";
    if($checkgmail==$realgmail){
    $exists = FindUserByEmail($Email);
    $uppercase = preg_match('@[A-Z]@', $Password);
$lowercase = preg_match('@[a-z]@', $Password);
$number    = preg_match('@[0-9]@', $Password);
$illegal = "~`!@#$%^&*()_-+={[]}:;'<>?/,.\|";
$symbol = strpbrk($Password, $illegal);
$checktel1 =  preg_match('@[A-Z]@', $Tel);
$checktel2 = preg_match('@[a-z]@', $Tel);
$checktel3 = strpbrk($Tel, $illegal);
    if ($exists) {
        echo '<div class="alert alert-danger" role="alert">' . 'Email already exists =,=!' . '</div>';
    } else if(!$uppercase || !$lowercase || !$number || $symbol) {
        echo '<div class="alert alert-danger" role="alert">' . 'Password must have at least 1 uppercase,1 lowercase,1 number and no special character =,=!' . '</div>';
    }else if (strlen($Password) > 50 && strlen($Password) < 3){
        echo '<div class="alert alert-danger" role="alert">' . 'Password must be at least 3 characters and less than 50 characters =,= ' . '</div>';
    }else{
			if ($Password != $confirmPassword) {
                echo '<div class="alert alert-danger" role="alert">' . 'Password incorrect =,=!' . '</div>';
            } else if($checktel1 || $checktel2 || $checktel3 || strlen($Tel) != 10){
                echo '<div class="alert alert-danger" role="alert">' . 'This is not phone number =,=!' . '</div>';
            }else
			{

                $code = strtoupper(base64_encode(random_bytes(4)));
               $id1 = GetMaxUserId();
               if($id1 == null){
                   $id = 1;
               }else{
                $id=(int)$id1+1;
               }
               $rp = sendEmail($Email,'Vertify your account','Click this link to active your account http://localhost/doan/active.php?id=' .$id.'&code='.$code);
            
             if($rp == 1){
                $user = CreateUser($Email,password_hash($Password,PASSWORD_DEFAULT),$Name,$Tel,$Address,$code,$Category,$id);
                header('Location:report.php');
                }else{
               header('Location:erro404notfound.php');
                }
			} 
    }
    }else{
        echo '<div class="alert alert-danger" role="alert">' . 'This is not email =,=' . '</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Open Sans", sans-serif;
        }
        
         :root {
            --form-height: 550px;
            --form-width: 900px;
            /*  Sea Green */
            --left-color: #3AC5C9;
            /*  Light Blue  */
            --right-color: #96dbe2;
        }
        
        body,
        html {
            width: 100%;
            height: 100%;
            margin: 0;
            font-family: "Open Sans", sans-serif;
            letter-spacing: 0.5px;
        }
        
        .container {
            width: var(--form-width);
            height: var(--form-height);
            position: relative;
            margin: auto;
            box-shadow: 2px 10px 40px rgba(22, 20, 19, 0.4);
            border-radius: 10px;
            margin-top: 50px;
            padding: 0px;
        }
        
        .button {
            background-color: #3AC5C9;
            border: none;
            color: white;
            padding: 15px 32px;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer
        }
        
        .overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: 100;
            background-image: linear-gradient( to right, var(--left-color), var(--right-color));
            border-radius: 10px;
            color: white;
            clip: rect(0, 385px, var(--form-height), 0);
        }
        
        .overlay .background {
            /*  Width is 385px - padding  */
            --padding: 50px;
            width: calc(480px - var(--padding) * 2);
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            padding: 0px var(--padding);
            text-align: center;
            float: left;
        }
        
        .form {
            width: 100%;
            height: 100%;
            position: absolute;
            border-radius: 10px;
        }
        
        .form .sign-up {
            --padding: 50px;
            position: absolute;
            /*  Width is 100% - 300px - padding  */
            width: calc(var(--form-width) - 300px - var(--padding) * 2);
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            padding: 0px var(--padding);
            text-align: center;
            right: 0;
        }
        
        #sign-up-form input {
            margin: 12px;
            font-size: 14px;
            padding: 15px;
            width: 350px;
            font-weight: 300;
            border: none;
            background-color: #e4e4e494;
            font-family: "Open Sans", sans-serif;
            letter-spacing: 1.5px;
            padding-left: 20px;
        }
        
        .clear {
            clear: both
        }
    </style>
</head>

<body>
<div style="float: top;">
    <a type="button" href="index.php">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
</svg>
    </a>
    </div>
    <div class="container">
        <div class="overlay" id="overlay">
            <div class="background" id="background">
                <img src="images/b1.png" />
            </div>
        </div>
        <div class="form">
            <form class="sign-up" method="POST" action="register.php">
                <h1 style="color: #3AC5C9; font-weight: bold;">Register</h1>
                <div id="sign-up-form">
                    <input type="text" name="Name" id="Name" class="form-control" placeholder="Fullname" required>
                    <input type="text" name="Address" id="Address" class="form-control" placeholder="Address" required>
                    <input type="text" name="Tel" id="Tel" class="form-control" placeholder="Tel" required>
                    <input type="text" name="Email" id="Email" class="form-control" placeholder="Email" required>
                    <input type="password" name="Password" id="Password" class="form-control" placeholder="Password" required>
                    <input type="password" name="ConfirmPassword" id="ConfirmPassword" class="form-control" placeholder="Confirm Password" required>
                </div>
                <div class="row">
                    <div class="form-check col-6">
                        <input class="form-check-input" type="radio" name="Category" id="customer" value="customer" checked>
                        <label class="form-check-label" for="customer">
                      Customer
                    </label>
                    </div>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="radio" name="Category" id="admin" value="admin">
                        <label class="form-check-label" for="admin">
                      Admin
                    </label>
                    </div>
                </div>
                <button class="button" type="submit">Register</button>
            </form>
        </div>
    </div>
</body>

</html>



