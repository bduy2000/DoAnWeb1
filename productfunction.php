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
function GetCountFavoriteProduct(){
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) AS soluong FROM products WHERE Status=?");
    $stmt->execute (array("Favorite"));
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
// load comment cua product
function loadcomment($id){
    global $db;
    $stmt = $db->prepare("SELECT u.Name,u.Avatar,a.Content,a.image,a.Time FROM activeuser a join products p on a.ProductID = p.Id join users u on u.Id = a.UserId   WHERE a.ProductId=? AND a.Active=?");
$stmt->execute (array($id,"Comment")); 
return $stmt->fetchAll();
}
// them comment cho product
function AddComment($userid,$productid,$comment,$image){
    global $db;
    $stmt = $db->prepare("INSERT INTO activeuser(UserId,Active,Content,ProductId,image) VALUE(?,?,?,?,?)");
    $stmt->execute (array($userid,'Comment',$comment,$productid,$image));
}
// xem coi product nay user co thich hay ko
function CheckProductIsUserFavorite($productid,$userid){
    global $db;
    $stmt = $db->prepare("SELECT * FROM activeuser a  WHERE a.UserID=? AND a.ProductId=? AND a.Active=?");
$stmt->execute (array($userid,$productid,'Like')); 
return $stmt->fetch(PDO::FETCH_ASSOC);
}
function Like($userid,$product){
    global $db;
    $stmt = $db->prepare("INSERT INTO activeuser(UserId,Active,ProductId) VALUE(?,?,?)");
    $stmt->execute (array($userid,'Like',$product['Id']));
    $stmt = null;
    $like = (int)$product['Like']+1;
    $stmt = $db->prepare("UPDATE products SET `Like` = ? WHERE Id=?");
    $stmt->execute(array($like,$product['Id']));
}
function Unlike($userid,$product){
    global $db;
    $stmt = $db->prepare("DELETE from activeuser WHERE UserId=? AND ProductId=? AND Active=? ");
    $stmt->execute (array($userid,$product['Id'],'Like'));
    $stmt = null;
    $like = (int)$product['Like']-1;
    $stmt = $db->prepare("UPDATE products SET `Like` = ? WHERE Id=?");
    $stmt->execute(array($like,$product['Id']));
}
function getSearch($search){
    global $db;
    $truyvan = '%'.$search.'%';
    $stmt = $db->prepare("SELECT * FROM `products` WHERE `Name` LIKE ?");
    $stmt->execute(array($truyvan));
    return $stmt->fetchAll();
}
function getSearchCount($search){
    global $db;
    $truyvan = '%'.$search.'%';
    $stmt = $db->prepare("SELECT COUNT(*) as soluong FROM `products` WHERE `Name` LIKE ?");
    $stmt->execute(array($truyvan));
    $test = $stmt->fetch(PDO::FETCH_ASSOC);
    return $test['soluong'];
}