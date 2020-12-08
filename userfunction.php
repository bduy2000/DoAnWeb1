    
<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
//  load user khi da dang nhap
    function GetCurrentUser()
 {
    if(isset($_SESSION['userId'])){
        return FindUserById($_SESSION['userId']);
    }
    return null;
}
//lay id lon nhat
function GetMaxUserId(){
    global $db;
    $stmt = $db->prepare("SELECT MAX(u.Id) as maxid FROM users u");
    $stmt->execute();
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['maxid'];
}
// kt Email co ton tai hay khong
function FindUserByEmail($Email){
    global $db;
	$stmt = $db->prepare("SELECT * FROM users WHERE Email=?");
$stmt->execute (array($Email)); 
return $stmt->fetch(PDO::FETCH_ASSOC);
}

// doi mat khau
function ChangeUserPassword($Email,$Password){
    global $db;
	$stmt = $db->prepare("UPDATE users SET Password=? WHERE Email=?");
$stmt->execute (array($Password,$Email)); 
}

// tao tai khoan cho user
function CreateUser($Email,$Password,$Name,$Tel,$Address,$Code,$Category,$id){
    global $db;    
	$stmt = $db->prepare("INSERT INTO users (Id,Email,Password,Name,Tel,Address,Code,Category) VALUES(?,?,?,?,?,?,?,?)");
$stmt->execute (array($id,$Email,$Password,$Name,$Tel,$Address,$Code,$Category)); 
return FindUserById($id);
}
// active tai khoan cho user
function ActiveUser($Id){
    global $db;
    $stmt = $db->prepare("UPDATE users SET Code = NULL WHERE Id=?");
    $stmt->execute (array($Id)); 
}
// thiet lap ma Code cho user
function UpdateCode($Email,$Code){
    global $db;
	$stmt = $db->prepare("UPDATE users SET Code = ? WHERE Email=?");
$stmt->execute (array($Code,$Email)); 
}
//tim user bang Id
function FindUserById($Id){
    global $db;
	$stmt = $db->prepare("SELECT * FROM users WHERE Id=?");
$stmt->execute (array($Id)); 
return $stmt->fetch(PDO::FETCH_ASSOC);
}
//Doi thong tin User
//Doi so dien thoai
function UpdateUserTel($Id,$Tel){
    global $db;
	$stmt = $db->prepare("UPDATE users SET Tel = ? WHERE Id=?");
$stmt->execute (array($Tel,$Id)); 
}
//Doi dia chi
function UpdateUserAddress($Id,$Address){
    global $db;
	$stmt = $db->prepare("UPDATE users SET Address = ? WHERE Id=?");
$stmt->execute (array($Address,$Id)); 
}
//Doi ten
function UpdateUserName($Id,$Name){
    global $db;
	$stmt = $db->prepare("UPDATE users SET Name = ? WHERE Id=?");
$stmt->execute (array($Name,$Id)); 
}
//Doi avatar
function UpdateAvatar($Id,$Avatar){
    global $db;
	$stmt = $db->prepare("UPDATE users SET Avatar = ? WHERE Id=?");
$stmt->execute (array($Avatar,$Id)); 
}