<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
//Them san pham
function AddProduct($id,$name,$price,$quantity,$decription,$status,$avatar,$type){
    global $db;
    if($status == 'Favorite'){
        $like = 4000;
    }else if($status == 'Best Sale'){
    $like= 6000;
    }else{
    $like = 3000;
    }    
    
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
// lay danh sach orders finish
function GetOrderListFinish(){
    global $db;
    $stmt = $db->prepare("SELECT o.Id,u.Name,o.Total,o.CMND,o.Tel,o.Address,o.Status,o.Time FROM orders o join users u on o.UserId = u.Id WHERE o.Status=? AND u.Category=?");
    $stmt->execute(array('finish','customer'));
    return $stmt->fetchAll();
}
// lay danh sach orders Pending
function GetOrderList(){
    global $db;
    $stmt = $db->prepare("SELECT o.Id,u.Name,o.Total,o.CMND,o.Tel,o.Address,o.Status,o.Time FROM orders o join users u on o.UserId = u.Id WHERE u.Category=?");
    $stmt->execute(array('customer'));
    return $stmt->fetchAll();
}
// lay danh sach customer
function GetCustomerList(){
    global $db;
    $stmt = $db->prepare("SELECT * FROM users u WHERE u.Category=?");
    $stmt->execute(array('customer'));
    return $stmt->fetchAll();
}
//Update status order
function UpdateStatusOrder($status,$id){
    global $db;
    $stmt = $db->prepare("UPDATE orders set Status=? WHERE Id=?");
    $stmt->execute(array($status,$id));
}
//Del Product
function DelProduct($id){
    global $db;
    $stmt = $db->prepare("DELETE FROM products WHERE Id=?");
    $stmt->execute(array($id));
}
//Edit Product
//Sua ten
function RenameProduct($name,$id){
    global $db;
    $stmt = $db->prepare("UPDATE products set Name=? WHERE Id=?");
    $stmt->execute(array($name,$id));
}
//Sua Quantity
function ReQuantityProduct($quantity,$id){
    global $db;
    $stmt = $db->prepare("UPDATE products set `StoreQuantity`=? WHERE Id=?");
    $stmt->execute(array($quantity,$id));
}
//Sua avatar
function ReAvatarProduct($avatar,$id){
    global $db;
    $stmt = $db->prepare("UPDATE products set Avatar0=? WHERE Id=?");
    $stmt->execute(array($avatar,$id));
}
//Sua Decription
function ReDecriptonProduct($decription,$id){
    global $db;
    $stmt = $db->prepare("UPDATE products set Decription=? WHERE Id=?");
    $stmt->execute(array($decription,$id));
}
//Sua Price
function RePriceProduct($price,$id){
    global $db;
    $stmt = $db->prepare("UPDATE products set `Price`=? WHERE Id=?");
    $stmt->execute(array($price,$id));
}
// Sua type
function ReTypeProduct($type,$id){
    global $db;
    $stmt = $db->prepare("UPDATE products set Type=? WHERE Id=?");
    $stmt->execute(array($type,$id));
}
// Sua Status
function ReStatusProduct($status,$id){
    global $db;
    if($status == 'Favorite'){
        $like = 4000;
    }else if($status == 'Best Sale'){
    $like= 6000;
    }else{
    $like = 3000;
    }    
    $stmt = $db->prepare("UPDATE products SET `Like` = ? WHERE Id=?");
    $stmt->execute(array($like,$id));
    $stmt = null;
    $stmt = $db->prepare("UPDATE products set Status = ? WHERE Id=?");
    $stmt->execute(array($status,$id));
}
//Sua anh phu
function RePictureProduct($picture,$id,$product){
    global $db;
    $index = 1;
    while($product[$index]){
    $truyvan = 'UPDATE products SET Avatar'.$index.' = null WHERE Id = ?';
    $stmt = $db->prepare($truyvan);
    $stmt->execute(array($id));
        $index = $index + 1;
    }
    $index = 1;
    $i = 0;
    while($picture[$i]){
        $truyvan2 = 'UPDATE products SET Avatar'.$index.' = ? WHERE Id = ?';
        $stmt2 = $db->prepare($truyvan2);
        $stmt2->execute(array($picture[$i],$id));
        $stmt2 = null;
            $index = $index + 1;
            $i = $i +1;
        }
}
// Tong doanh thu theo ngay hien tai
function Doanhthutheongayht(){
    global $db;
    $date = date("Y/m/d");
    $stmt = $db->prepare("SELECT SUM(o.Total) as total FROM orders o join users u on o.UserId = u.Id WHERE DATE(o.Time)= ? AND o.Status=? AND u.Category=?");
    $stmt->execute(array($date,'finish','customer'));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Tong doanh thu theo thang hien tai
function Doanhthutheothanght(){
    global $db;
    $date = date('n');
    $stmt = $db->prepare("SELECT SUM(o.Total) as total FROM orders o join users u on o.UserId = u.Id WHERE MONTH(o.Time)=? AND o.Status=? AND u.Category=?");
    $stmt->execute(array($date,'finish','customer'));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
//Tong doanh thu theo nam hien tai
function Doanhthutheonamht(){
    global $db;
    $date = date("Y");
    $stmt = $db->prepare("SELECT SUM(o.Total) as total FROM orders o join users u on o.UserId = u.Id WHERE YEAR(o.Time)=? AND o.Status=? AND u.Category=?");
    $stmt->execute(array($date,'finish','customer'));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Tong doanh thu theo quy hien tai
function Doanhthutheoquyht(){
    global $db;
    $date = date('n');
    $year = date("Y");
    if($date >=1 && $date < 4){
        $start = 1;
        $end = 3;
    }
    else if($date >=4 && $date < 7){
        $start = 4;
        $end = 6;
    }else if($date >=7 && $date < 10){
        $start = 7;
        $end = 9;
    }else{
        $start = 10;
        $end = 12;
    }
    $stmt = $db->prepare("SELECT SUM(o.Total) as total FROM orders o join users u on o.UserId = u.Id WHERE MONTH(o.Time) >= ? AND MONTH(o.Time) <= ? AND YEAR(o.Time) = ? AND o.Status=? AND u.Category=?");
    $stmt->execute(array($start,$end,$year,'finish','customer'));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


