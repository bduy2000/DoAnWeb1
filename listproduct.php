<?php
require_once 'init.php';
$search = $_GET['search'];
$type = $_GET['type'];
if($currentUser){
$userid = $currentUser['Id'];
}
$page1 = $_GET['page'];
$page = (int)$page1;
if($search){
    $array=getSearch($search);
    $sl=getSearchCount($search);

}
if($type){
switch($type){
    case "new":
        $array=getNewProduct();
        $sl = GetCountNewProduct();
    break;
    case "best-sale":
        $array=getHotProduct();
        $sl = GetCountHotProduct();
    break;
    case "favorite":
        $array=getFavoriteProduct();
        $sl = GetCountFavoriteProduct();
    break;
    case "Userfavorite":
        $array=getUserFavorite($userid);
        $sl = getCountUserFavorite($userid);
    break;
default:
$array=GetProductByType($type);
$sl = GetCountProductByType($type);
}
}
if($sl % 12 == 0){
    $slpage1 = $sl/12;
}else{
    $slpage1 = $sl/12;
    $slpage1 = $slpage1 + 1;
}
if($page == 1 || $page == 0){
$page = 1;
$max = 12;
$index = 0;
}else{
$max = $page * 12;
$index = $max-12; 
}
$i = 1;
$slpage = (int)$slpage1;
if(isset($_POST['cart'])){
	$getproductdetail = findproductbyId($_POST['cart']);
	if($currentUser){
        
        $soluong= 1;
        
        
            $hihi = getbag($_POST['cart'],$currentUser['Id'],$soluong,$getproductdetail['Price']);
            if($hihi == 1){
                header("Refresh:0");
            }else {
                $error = 'So luong ton khong du  :<';
            }

    }else{
        $error = 'You must login to buy';
    }
}

?>

<?php include 'header.php'; ?>
<?php if ($error): ?>
<div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
</div>
<?php endif;?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Product</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style >


body {
	font-family: "Open Sans", sans-serif;
}
h4 {
	color: #000;
	font-size: 16px;
	font-weight: bold;
	text-align: center;
	
	position: relative;
	
}
.star-rating li {
	padding: 0;
}
.star-rating i {
	font-size: 14px;
	color: #ffc000;
}
.item-price {
	font-size: 15px;
	
}

.item-price span {
	color: #c0581b;
	font-size: 110%;
    font-weight: bold;
}
.thumb-wrapper {
	text-align: center;
}
.thumb-content {
	padding: 15px;
}
.img-box {
	height: 250px;
	width: 100%;
	position: relative;
    border: 0.5px solid #ccc;
    padding: 5px 5px; 
   
}
.btn {
	color: #333;
    border-radius: 0;
    font-size: 11px;
    text-transform: uppercase;
    font-weight: bold;
    background: none;
    border: 1px solid #ccc;
    padding: 5px 10px; 
    margin-top: 5px; 
    line-height: 16px;
}
.btn:hover, .btn:focus {
	color: #fff;
	background: #000;
	border-color: #000;
	box-shadow: none;
}
.btn i {
	font-size: 14px;
    font-weight: bold;
    margin-left: 5px;
}
.center {
  text-align: center;
}

.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
  border-radius: 50%;
  font-size: 15px;
}

.pagination a.active {
  background-color: #3ac5c9;
  color: white;
  border: 1px solid #3ac5c9;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
</head>
<body>
<?php if($array == null):?>
<h2>Not thing to view :< </h2>
<?php endif;?>
</br>
</br>
</br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <?php $loai=str_replace("-"," ",$type);?>
    <li class="breadcrumb-item" style="font-size:20px"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="font-size:20px"><?php echo $loai?></li>
  </ol>
  </br>

</nav>
    <div class="container">
	    <div class="row">
        <?php while( $array[$index] && $index<$max): ?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
                            <a href="./productdetail.php?id=<?php echo $array[$index]['Id'] ?>">
								<div class="img-box">
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($array[$index]['Avatar0']) . '" class="img-responsive img-fluid" alt="" style="width:200px; height:200px">'?>
								</div>
								<div class="thumb-content">
									<h4><?php echo $array[$index]['Name'] ?></h4>
                                    <p class="item-price"><span><?php echo $array[$index]['Price'] ?></span></p>
									<div class="star-rating">
										<ul class="list-inline">
										<?php if ($array[$index]['Like'] > 5000):?>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
										<?php else:?>
										<?php $star = $array[$index]['Like']/1000;
										$nostar = 5 - $star;
										?>
										<?php while($star>=1):?>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<?php $star = $star-1;?>
										<?php endwhile;?>
										<?php while($nostar >= 1):?>
											<li class="list-inline-item"><i class="fa fa-star-o"></i></li>
											<?php $nostar = $nostar-1;?>
										<?php endwhile;?>
										<?php endif;?>
										</ul>
									</div>
								</div>						
                                </a>
                                <?php if($array[$index]['StoreQuantity'] > 0):?>
								<form action="listproduct.php?type=<?php echo $type?>&page=<?php echo $i?><?php if($userid):?><?php echo '&userid='.$userid?><?php endif;?><?php if($search){echo'&search='.$search;}?>" method="post">
								<button type="submit" name="cart" value="<?php echo $array[$index]['Id'] ?>" class="btn btn-primary">Add to Cart</button>	
								</form>
							
								<?php else:?>
								<h>Het hang</h>
								<?php endif;?>	
							</div>
						</div>
        <?php $index =$index +1; ?>
        <?php endwhile;?>
            </div>
                    <div class="center">
                        <div class="pagination">
                        <a href="./listproduct.php?type=<?php echo $type?>&page=<?php if($page - 1 < 1):?><?php $page =1;?><?php echo $page?><?php else:?><?php $new1 =$page-1?><?php echo $new1?><?php endif;?><?php if($userid):?><?php echo '&userid='.$userid?><?php endif;?><?php if($search){echo'&search='.$search;}?>">&laquo;</a>
                        <?php while($i <= $slpage): ?>
                        <?php if($i == $page):?>
                            <a href="./listproduct.php?type=<?php echo $type?>&page=<?php echo $i?><?php if($userid):?><?php echo '&userid='.$userid?><?php endif;?><?php if($search){echo'&search='.$search;}?>" class="active"><?php echo $i?></a>
                        <?php else:?>
                            <a href="./listproduct.php?type=<?php echo $type?>&page=<?php echo $i?><?php if($userid):?><?php echo '&userid='.$userid?><?php endif;?><?php if($search){echo'&search='.$search;}?>"><?php echo $i?></a>
                        <?php endif;?>              
                        <?php $i = $i+1;?>
                        <?php endwhile;?>
                        <a href="./listproduct.php?type=<?php echo $type?>&page=<?php if($page + 1 > $slpage):?><?php echo $page?><?php else:?><?php $new2 = $page + 1;?><?php echo $new2?><?php endif;?><?php if($userid):?><?php echo '&userid='.$userid?><?php endif;?><?php if($search){echo'&search='.$search;}?>">&raquo;</a>
                        </div>
                      </div>
	</div>         
    <?php include 'footer.php'; ?>