
<?php
require_once 'init.php';

$title = 'Changepassword';

if (isset($_POST['oldpassword']) && isset($_POST['password']) && isset($_POST['confirmpassword']) ) {
    
    $oldpass = $_POST['oldpassword'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$illegal = "~`!@#$%^&*()_-+={[]}:;'<>?/,.\|";
$symbol = strpbrk($password, $illegal);
    
    if(!password_verify($oldpass,$currentUser['Password'])){
        echo '<div class="alert alert-danger" role="alert">' . 'Old Password incorrect' . '</div>';
    }else{
            if ($password != $confirmpassword) {
                echo '<div class="alert alert-danger" role="alert">' . 'New Password incorrect' . '</div>';
            }else if(!$uppercase || !$lowercase || !$number || $symbol) {
                echo '<div class="alert alert-danger" role="alert">' . 'Password must have at least 1 uppercase,1 lowercase,1 number and no special character =,=!' . '</div>';
            }else if (strlen($password) > 50 && strlen($password) < 3){
                echo '<div class="alert alert-danger" role="alert">' . 'Password must be at least 3 characters and less than 50 characters =,= ' . '</div>';
            }else{
			
                echo '<div class="alert alert-success" role="alert">' . 'Success Change' . '</div>';
               ChangeUserPassword($currentUser['Email'],password_hash($password, PASSWORD_DEFAULT));		
            }
        }
}
?>
<?php include 'profile.php'; ?>