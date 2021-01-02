<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
//Them san pham
function AddProduct($id,$name,$price,$quantity,$decription,$status,$avatar,$type){
    global $db;    
    $like = 100;
	$stmt = $db->prepare("INSERT INTO `products` (`Id`,`Name`,`Like`,`Price`,`StoreQuantity`,`Decription`,`Status`,`Type`) VALUES(?,?,?,?,?,?,?,?)");
    $stmt->execute (array($id,$name,$like,$price,$quantity,$decription,$status,$type));
    $len = count($avatar);
    $i2 = 0;
while($i2 < $len){
    $truyvan = 'UPDATE products SET Avatar'.$i2.' = ? WHERE Id = ?';
    $stmt1 = $db->prepare($truyvan);
    $stmt1 -> execute (array($avatar[$i2],$id));
    //$stmt1 = $db->prepare("INSERT INTO `productpicture` (`productid`,`STT`,`Avatar`) VALUES(?,?,?)");
    //$stmt1->execute (array($id,$i2,$avatar[$i2]));
    $stmt1 = null;
    $i2=$i2 + 1;
} 
}

//lay id lon nhat
function GetMaxProductId(){
    global $db;
    $stmt = $db->prepare("SELECT MAX(u.Id) as maxid FROM products u");
    $stmt->execute();
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['maxid'];
}