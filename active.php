<?php
require_once 'init.php';

$code = $_GET['code'];
$id = $_GET['id'];
$user = FindUserById($id);

if($user){
        if($user['Code']){
            if($user['Code'] == $code){
                ActiveUser($id);
                $_SESSION['userId'] = $id;
                header('Location:index.php');
            }else{
            $erro = 'This code is dead';
            }
        }else{
        $erro = 'Your account was active';
}
}else{
    $erro = 'Your account was not exists';
}
?>
<?php include 'header.php'; ?>
<div class="alert alert-success" role="alert">
    Hi <?php echo $erro;?>
</div>
