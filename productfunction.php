<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
function findproductbyId($Id){
    global $db;
	$stmt = $db->prepare("SELECT * FROM products WHERE Id=?");
$stmt->execute (array($Id)); 
return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getNewProduct(){
        global $db;
        $stmt = $db->prepare("SELECT * FROM products WHERE Status=?");
    $stmt->execute (array("New")); 
    return $stmt->fetchAll();
}
function getHotProduct(){
    global $db;
    $stmt = $db->prepare("SELECT * FROM products WHERE Status=?");
$stmt->execute (array("Best Sale")); 
return $stmt->fetchAll();
}
function getAllProduct(){
    global $db;
    $stmt = $db->prepare("SELECT * FROM products");
$stmt->execute (); 
return $stmt->fetchAll();
}
function getFavoriteProduct(){
    global $db;
        $stmt = $db->prepare("SELECT * FROM products WHERE Status=?");
    $stmt->execute (array("Favorite")); 
    return $stmt->fetchAll();
}
function getUserFavorite($id){
    global $db;
    $stmt = $db->prepare("SELECT * FROM activeuser a join products p on a.ProductID = p.Id  WHERE a.UserID=? AND a.Active=?");
$stmt->execute (array($id,"Like")); 
return $stmt->fetchAll();
}
function getCountUserFavorite($id){
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) AS soluong FROM activeuser a join products p on a.ProductID = p.Id  WHERE a.UserID=? AND a.Active=?");
    $stmt->execute (array($id,"Like"));
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['soluong'];
}
function GetCountNewProduct(){
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) AS soluong FROM products WHERE Status=?");
    $stmt->execute (array("New"));
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['soluong'];
}
function GetCountHotProduct(){
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) AS soluong FROM products WHERE Status=?");
    $stmt->execute (array("Best Sale"));
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['soluong'];
}
function GetCountAllProduct(){
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) AS soluong FROM products ");
    $stmt->execute ();
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['soluong'];
}
function GetProductByType($type){
    global $db;
        $stmt = $db->prepare("SELECT * FROM products WHERE Type=?");
    $stmt->execute (array($type)); 
    return $stmt->fetchAll();
}
function GetCountProductByType($type){
    global $db;
        $stmt = $db->prepare("SELECT COUNT(*) AS soluong FROM products WHERE Type=?");
    $stmt->execute (array($type)); 
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['soluong'];
}
function loadcomment($id){
    global $db;
    $stmt = $db->prepare("SELECT u.Name,u.Avatar,a.Content,a.image,a.Time FROM activeuser a join products p on a.ProductID = p.Id join users u on u.Id = a.UserId   WHERE a.ProductId=? AND a.Active=?");
$stmt->execute (array($id,"Comment")); 
return $stmt->fetchAll();
}