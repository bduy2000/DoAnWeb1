<?php
require_once 'init.php';

$code = $_GET['code'];
$id = $_GET['id'];
$user = findUserById($id);
if($user['Code'] != $code){

    $erro = 'Code was deleted';
}
if ( isset($_POST['password']) && isset($_POST['confirmpassword']) && $user && $user['Code'] != null) {
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$illegal = "~`!@#$%^&*()_-+={[]}:;'<>?/,.\|";
$symbol = strpbrk($password, $illegal);
if(password_verify($password,$user['Password'])){
    $erro='This is your old password';
}else{
        if ($password != $confirmpassword) {
                $erro='New Password incorrect' ;
            } else if(!$uppercase || !$lowercase || !$number || $symbol) {
                $erro= 'Password must have at least 1 uppercase,1 lowercase,1 number and no special character =,=!';
            }else if (strlen($password) > 50 && strlen($password) < 3){
                $erro= 'Password must be at least 3 characters and less than 50 characters =,= ';
            }else{
                $erro2='Success Change';
               ChangeUserPassword($user['Email'],password_hash($password, PASSWORD_DEFAULT));
               ActiveUser($id);
               $_SESSION['userId'] = $id;
                header('Location:index.php');
			} 				
}
}
?>
<?php include 'header.php'; ?>
<?php if($erro2):?>
<div class="alert alert-success" role="alert">
<?php echo $erro2;?>
</div>
<?php endif;?>
<?php if($erro):?>
<div class="alert alert-danger" role="alert">
<?php echo $erro;?>
</div>
<?php endif;?>
<?php if($user['Code'] != null): ?>
<form action="activepass.php?id=<?php echo $id?>&code=<?php echo $code ?>" method="POST">
    <div class="form-group">
        <label for="password">New password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="confirmpassword">Confirm password </label>
        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" required>
    </div>
    <button button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php endif;?>
