<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);

function getbag($productid,$userid,$quantity,$price){
 $sl1  = CheckQuantity($productid);
 $sl =(int)$sl1;

 if($quantity > $sl){
     return 0;
 }else{
    $check = ktbag($productid,$userid);
    if($check){
        $slht1 = GetQuantity($productid,$userid);
        $slht = (int)$slht1;
        $slao = $slht + (int)$quantity;
        if($slao > $sl){
            return 0;
        }else{
        //update
        UpdateQuantity($productid,$userid,$quantity,$price);
        return 1;
        }
    }else{
        //add
    CreateBag($productid,$userid,$quantity,$price);
    return 1;
    }
 }

}
//kt sl ton
function CheckQuantity($productid){
    global $db;
    $stmt = $db->prepare("SELECT StoreQuantity FROM products p WHERE p.Id = ?");
    $stmt->execute(array($productid));
    $test= $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['StoreQuantity'];
}
//tao gio hang
function CreateBag($productid,$userid,$quantity,$price){
    global $db;    
	$stmt = $db->prepare("INSERT INTO bag (productid,userid,Total,Quantity) VALUES(?,?,?,?)");
$stmt->execute (array($productid,$userid,$price*$quantity,$quantity)); 
}
//kt gio hang
function ktbag($productid,$userid){
    global $db;
	$stmt = $db->prepare("SELECT * FROM bag WHERE productid = ? AND userid = ?");
$stmt->execute (array($productid,$userid)); 
return $stmt->fetch(PDO::FETCH_ASSOC);
}
//Lay so luong
function GetQuantity($productid,$userid){
    global $db;
    $stmt = $db->prepare("SELECT Quantity FROM bag b WHERE b.userid = ? AND b.productid = ?");
    $stmt->execute(array($userid,$productid));
    $test= $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['Quantity'];
}
//update so luong
function UpdateQuantity($productid,$userid,$quantity,$price){
    global $db;
    $quantity1 = GetQuantity($productid,$userid);
    $quantity = $quantity + $quantity1;
	$stmt = $db->prepare("UPDATE bag SET Quantity = ? WHERE userid=? AND productid = ?");
    $stmt->execute (array($quantity,$userid,$productid));

    $stmt = $db->prepare("UPDATE bag SET Total = ? WHERE userid=? AND productid = ?");
    $stmt->execute (array($price*$quantity,$userid,$productid));
}
//xoa bag item
function DelBagItem($productid,$userid){
    global $db;
    $stmt = $db->prepare("DELETE FROM bag  WHERE userid = ? AND productid = ?");
    $stmt->execute(array($userid,$productid));
}
// lay tat ca san pham trong bag cua user
function UserBag($userid){
        global $db;
        $stmt = $db->prepare("SELECT * FROM bag b join products p ON b.productid = p.Id WHERE b.userid=?");
    $stmt->execute (array($userid)); 
    return $stmt->fetchAll();
}
// del bag
function DelBag($userid){
    global $db;
    $stmt = $db->prepare("DELETE FROM bag  WHERE userid = ?");
    $stmt->execute(array($userid));
}
// add listoder
function DelBag($userid){
    global $db;
    $stmt = $db->prepare("DELETE FROM bag  WHERE userid = ?");
    $stmt->execute(array($userid));
}