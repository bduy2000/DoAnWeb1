<?php require_once 'init.php';?>
<?php
if($currentUser['Category'] == 'admin'){
	header('Location:dashbroadadmin.php');
}
//Lay count cua trending book va new book
$counthot = GetCountHotProduct();
$countnew = GetCountNewProduct();
$countfavorite = GetCountFavoriteProduct();
//Lay danh sach cua trending book va new book
$newproduct = getNewProduct();
$hotproduct = getHotProduct();
$favorite = getFavoriteProduct();
//chi lay 12 product
if($counthot > 12){
	$counthot=12;
}
if($countnew > 12){
	$countnew = 12;
}
if($countfavorite > 12){
	$countfavorite = 12;
}
$solanlapnewproduct = $countnew / 4;
$solanlaphotproduct = $counthot / 4;
$solanlapfavoriteproduct = $countfavorite / 4;

$i = 1;
$i1=0;
$i2=0;
$i3=0;
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
<title>Home</title>
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
h2 {
	color: #000;
	font-size: 26px;
	font-weight: 300;
	text-align: center;
	text-transform: uppercase;
	position: relative;
	margin: 30px 0 80px;
}
h2 b {
	color:  #FF5E18;
}
h2::after {
	content: "";
	width: 100px;
	position: absolute;
	margin: 0 auto;
	height: 4px;
	background: rgba(0, 0, 0, 0.2);
	left: 0;
	right: 0;
	bottom: -20px;
}
.carousel {
	margin: 50px auto;
	padding: 0 70px;
}
.carousel .item {
	min-height: 330px;
    text-align: center;
	overflow: hidden;
}
.carousel .item .img-box {
	height: 160px;
	width: 100%;
	position: relative;
}
.carousel .item img {	
	max-width: 100%;
	max-height: 100%;
	display: inline-block;
	position: absolute;
	bottom: 0;
	margin: 0 auto;
	left: 0;
	right: 0;
}
.carousel .item h4 {
	font-size: 18px;
	margin: 10px 0;
}
.carousel .item .btn {
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
.carousel .item .btn:hover, .carousel .item .btn:focus {
	color: #fff;
	background: #000;
	border-color: #000;
	box-shadow: none;
}
.carousel .item .btn i {
	font-size: 14px;
    font-weight: bold;
    margin-left: 5px;
}
.carousel .thumb-wrapper {
	text-align: center;
}
.carousel .thumb-content {
	padding: 15px;
}
.carousel .carousel-control {
	height: 100px;
    width: 40px;
    background: none;
    margin: auto 0;
    background: rgba(0, 0, 0, 0.2);
}
.carousel .carousel-control i {
    font-size: 30px;
    position: absolute;
    top: 50%;
    display: inline-block;
    margin: -16px 0 0 0;
    z-index: 5;
    left: 0;
    right: 0;
    color: rgba(0, 0, 0, 0.8);
    text-shadow: none;
    font-weight: bold;
}
.carousel .item-price {
	font-size: 13px;
	padding: 2px 0;
}

.carousel .item-price span {
	color: #8fc217;
	font-size: 110%;
}
.carousel .carousel-control.left i {
	margin-left: -3px;
}
.carousel .carousel-control.left i {
	margin-right: -3px;
}
.carousel .carousel-indicators {
	bottom: -50px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 10px;
	height: 10px;
	margin: 4px;
	border-radius: 50%;
	border-color: transparent;
}
.carousel-indicators li {	
	background: rgba(0, 0, 0, 0.2);
}
.carousel-indicators li.active {	
	background: rgba(0, 0, 0, 0.6);
}
.star-rating li {
	padding: 0;
}
.star-rating i {
	font-size: 14px;
	color: #ffc000;
}

.pb-60 {
	padding-bottom: 60px;
}
.pt-60 {
	padding-top: 60px;
}
.mb-60 {
	margin-bottom: 60px;
}
.section-title p {
	font-size: 24px;
	font-family: Oleo Script;
	margin-bottom: 0px;
}
.section-title h4 {
	font-size: 40px;
	text-transform: capitalize;
	color: #FF5E18;
	position: relative;
	display: inline-block;
	padding-bottom: 25px;
}
.section-title h4::before {
	width: 80px;
	height: 1.5px;
	bottom: 0;
	left: 50%;
	margin-left: -40px;
}
.section-title h4::before, .section-title h4::after {
	position: absolute;
	content: "";
	background-color: #FF5E18;
}
.section-title h4::after {
	width: 40px;
	height: 1.5px;
	bottom: -5px;
	left: 50%;
	margin-left: -20px;
}
.single_service.service_right {
	padding-right: 70px;
	padding-left: 0;
	text-align: right;
}

.single_service:nth-child(1), .single_service:nth-child(2) {
	border-bottom: 1px dashed #333;
	padding-bottom: 15px;
}

.single_service {
	position: relative;
	padding-left: 70px;
	margin-bottom: 35px;
    font-size: medium;
}


  		.img_section figure img {
  			transform: scale(1);
  			transition: .3s ease-in-out;
  			height: 300;
  			width: 200;  			
  		}
		.img_section figure:hover img {
			transform: scale(1.3);
		}
		h2.zoom {
    padding-bottom: 33px;
    padding-left: 25px;
}
.img_section2 figure img {
	width: 300px;
	height: auto;
	transition: .3s ease-in-out;

}
.img_section2:hover figure img{
	width: 350px;
}
.img_section3 figure img{
	margin-left: 30px;
	width: 300px;
	transition: .3s ease-in-out;
}
.img_section3:hover figure img{
	margin-left: 0;
	
}
.img_section4 figure img{
	transform:  scale(1);
	transition: .3s ease-in-out;
}
.img_section4:hover figure img{
	transform: rotate(10deg) scale(1);
	
}


ul, ol {
    list-style: none;
    padding: 0;
    margin: 0;
}

</style>
</head>
<body>

<header>
<img style="width:100%" src="https://d2p7wwv96gt4xt.cloudfront.net/S/banners/banners_gift_cards_2020_updated_desktop.jpg">
</header>

<div class="row">
	<div class="col-md-12">
			<a href="./listproduct.php?type=best-sale"><h2>Trending <b>Books</b></h2></a>
	<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<?php while($i < $solanlaphotproduct):?>
				<?php echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>'?>
				<?php $i=$i+1; ?>
				<?php endwhile;?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
					<?php $index = 0  ?>
					<?php while($index < 4 && $hotproduct[$i1]): ?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							<a href="./productdetail.php?id=<?php echo $hotproduct[$i1]['Id']?>">
								<div class="img-box">
									<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($hotproduct[$i1]['Avatar0']) . '" class="img-responsive img-fluid" alt="">'?>
								</div>
								<div class="thumb-content">
								
									<h4><?php echo $hotproduct[$i1]['Name'] ?></h4>
									<p class="item-price"><span><?php echo $hotproduct[$i1]['Price'] . ' đ'?></span></p>
									<div class="star-rating">
										<ul class="list-inline">
										<?php if ($hotproduct[$i1]['Like'] > 5000):?>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
										<?php else:?>
										<?php $star = $hotproduct[$i1]['Like']/1000;
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
								<?php if($hotproduct[$i1]['StoreQuantity'] > 0):?>
								<form action="index.php" method="post">
								<button type="submit" name="cart" value="<?php echo $hotproduct[$i1]['Id'] ?>" class="btn btn-primary">Add to Cart</button>	
								</form>
							
								<?php else:?>
								<h>Het hang</h>
								<?php endif;?>			
							</div>
						</div>
						<?php $index = $index +1;?>
						<?php $i1 = $i1 +1;?>
						<?php endwhile;?>
					</div>
				</div>
				<!-- -->
				<?php while($solanlaphotproduct > 1):?>
				<div class="item carousel-item">
				<?php $index = 0; 
				
				?>
			
					<div class="row">
					<?php while($index < 4 && $hotproduct[$i1]):?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							<a href="./productdetail.php?id=<?php echo $hotproduct[$i1]['Id']?>">
								<div class="img-box">
								<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($hotproduct[$i1]['Avatar0']) . '" class="img-responsive img-fluid" alt="">'?>
								</div>
								<div class="thumb-content">
									<h4><?php echo $hotproduct[$i1]['Name'] ?></h4>
									<p class="item-price"><span><?php echo $hotproduct[$i1]['Price'] . ' đ'?></span></p>
									<div class="star-rating">
										<ul class="list-inline">
										<?php if ($hotproduct[$i1]['Like'] > 5000):?>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
										<?php else:?>
										<?php $star = $hotproduct[$i1]['Like']/1000;
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
								<?php if($hotproduct[$i1]['StoreQuantity'] > 0):?>
								<form action="index.php" method="post">
								<button type="submit" name="cart" value="<?php echo $hotproduct[$i1]['Id'] ?>" class="btn btn-primary">Add to Cart</button>	
								</form>
								<?php else:?>
								<h>Het hang</h>
								<?php endif;?>
							</div>
						</div>
					<?php $index = $index +1;?>
					<?php $i1 = $i1 + 1;?>
					<?php endwhile;?>				
					</div>
				</div>
				<?php $solanlaphotproduct = $solanlaphotproduct - 1;?>
				<?php endwhile;?>
	
				</div>
		
			<!-- Carousel controls -->
			<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>        
	</div>  
	</div>
<br>
<br>
<br>
<br>
<?php $i = 1;?>
<div class="row">
	<div class="col-md-12">
			<a href="./listproduct.php?type=new"><h2>New <b>Books</b></h2></a>
	<div id="myCarousel1" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
				<?php while($i < $solanlapnewproduct):?>
				<?php echo '<li data-target="#myCarousel1" data-slide-to="'.$i.'"></li>'?>
				<?php $i=$i+1; ?>
				<?php endwhile;?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
					<?php $index = 0  ?>
					<?php while($index < 4 && $newproduct[$i2]): ?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							<a href="./productdetail.php?id=<?php echo $newproduct[$i2]['Id']?>">
								<div class="img-box">
									<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($newproduct[$i2]['Avatar0']) . '" class="img-responsive img-fluid" alt="">'?>
								</div>
								<div class="thumb-content">
									<h4><?php echo $newproduct[$i2]['Name'] ?></h4>
									<p class="item-price"><span><?php echo $hotproduct[$index]['Price'] .' đ' ?></span></p>
									<div class="star-rating">
										<ul class="list-inline">
										<?php if ($newproduct[$i2]['Like'] > 5000):?>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
										<?php else:?>
										<?php $star = $newproduct[$i2]['Like']/1000;
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
									</a>
									<?php if($newproduct[$i2]['StoreQuantity'] > 0):?>
										<form action="index.php" method="post">
								<button type="submit" name="cart" value="<?php echo $newproduct[$i2]['Id'] ?>" class="btn btn-primary">Add to Cart</button>	
								</form>
								<?php else:?>
								<h>Het hang</h>
								<?php endif;?>	
								</div>						
							</div>
						</div>
						<?php $index = $index +1;?>
						<?php $i2 = $i2 +1;?>
						<?php endwhile;?>
					</div>
				</div>
				<!-- -->
				<?php while($solanlapnewproduct > 1):?>
				<div class="item carousel-item">
				<?php $index = 0; 
				
				?>
			
					<div class="row">
					<?php while($index < 4 && $newproduct[$i2]):?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							<a href="./productdetail.php?id=<?php echo $newproduct[$i2]['Id']?>">
								<div class="img-box">
								<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($newproduct[$i2]['Avatar0']) . '" class="img-responsive img-fluid" alt="">'?>
								</div>
								<div class="thumb-content">
									<h4><?php echo $newproduct[$i2]['Name'] ?></h4>
									<p class="item-price"><span><?php echo $newproduct[$i2]['Price'] ?></span></p>
									<div class="star-rating">
										<ul class="list-inline">
										<?php if ($newproduct[$i2]['Like'] > 5000):?>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
										<?php else:?>
										<?php $star = $newproduct[$i2]['Like']/1000;
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
									</a>
									<?php if($newproduct[$i2]['StoreQuantity'] > 0):?>
										<form action="index.php" method="post">
								<button type="submit" name="cart" value="<?php echo $newproduct[$i2]['Id'] ?>" class="btn btn-primary">Add to Cart</button>	
								</form>	
								<?php else:?>
								<h>Het hang</h>
								<?php endif;?>
								</div>						
							</div>
						</div>
					<?php $index = $index +1;?>
					<?php $i2 = $i2 + 1;?>
					<?php endwhile;?>				
					</div>
				</div>
				<?php $solanlapnewproduct = $solanlapnewproduct - 1;?>
				<?php endwhile;?>
	
				</div>
		
			<!-- Carousel controls -->
			<a class="carousel-control left carousel-control-prev" href="#myCarousel1" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control right carousel-control-next" href="#myCarousel1" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>        
	</div>  
	</div>
	</br>
	</br>
	</br>
<?php $i = 1;?>
<div class="row">
	<div class="col-md-12">
			<a href="./listproduct.php?type=favorite"><h2>Favourite <b>Books</b></h2></a>
	<div id="myCarousel2" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
				<?php while($i < $solanlapfavoriteproduct):?>
				<?php echo '<li data-target="#myCarousel2" data-slide-to="'.$i.'"></li>'?>
				<?php $i=$i+1; ?>
				<?php endwhile;?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
					<?php $index = 0  ?>
					<?php while($index < 4 && $favorite[$i3]): ?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							<a href="./productdetail.php?id=<?php echo $favorite[$i3]['Id']?>">
								<div class="img-box">
									<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($favorite[$i3]['Avatar0']) . '" class="img-responsive img-fluid" alt="">'?>
								</div>
								<div class="thumb-content">
									<h4><?php echo $favorite[$i3]['Name'] ?></h4>
									<p class="item-price"><span><?php echo $favorite[$i3]['Price'] .' đ'?></span></p>
									<div class="star-rating">
										<ul class="list-inline">
										<?php if ($favotite[$i3]['Like'] > 5000):?>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
										<?php else:?>
										<?php $star = $favorite[$i3]['Like']/1000;
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
									</a>
									<?php if($favorite[$i3]['StoreQuantity'] > 0):?>
										<form action="index.php" method="post">
								<button type="submit" name="cart" value="<?php echo $favorite[$i3]['Id'] ?>" class="btn btn-primary">Add to Cart</button>	
								</form>
								<?php else:?>
								<h>Het hang</h>
								<?php endif;?>	
								</div>						
							</div>
						</div>
						<?php $index = $index +1;?>
						<?php $i3 = $i3 +1;?>
						<?php endwhile;?>
					</div>
				</div>
				<!-- -->
				<?php while($solanlapfavoriteproduct > 1):?>
				<div class="item carousel-item">
				<?php $index = 0; 
				
				?>
			
					<div class="row">
					<?php while($index < 4 && $favorite[$i3]):?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							<a href="./productdetail.php?id=<?php echo $favorite[$i3]['Id']?>">
								<div class="img-box">
								<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($favorite[$i3]['Avatar0']) . '" class="img-responsive img-fluid" alt="">'?>
								</div>
								<div class="thumb-content">
									<h4><?php echo $favorite[$i3]['Name'] ?></h4>
									<p class="item-price"><span><?php echo $favorite[$i3]['Price'] .' đ' ?></span></p>
									<div class="star-rating">
										<ul class="list-inline">
										<?php if ($favorite[$i3]['Like'] > 5000):?>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
										<?php else:?>
										<?php $star = $favorite[$i3]['Like']/1000;
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
									</a>
									<?php if($favorite[$i3]['StoreQuantity'] > 0):?>
										<form action="index.php" method="post">
								<button type="submit" name="cart" value="<?php echo $favorite[$i3]['Id'] ?>" class="btn btn-primary">Add to Cart</button>	
								</form>	
								<?php else:?>
								<h>Het hang</h>
								<?php endif;?>
								</div>						
							</div>
						</div>
					<?php $index = $index +1;?>
					<?php $i3 = $i3 + 1;?>
					<?php endwhile;?>				
					</div>
				</div>
				<?php $solanlapfavoriteproduct = $solanlapfavoriteproduct - 1;?>
				<?php endwhile;?>
	
				</div>
		
			<!-- Carousel controls -->
			<a class="carousel-control left carousel-control-prev" href="#myCarousel2" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control right carousel-control-next" href="#myCarousel2" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>        
	</div>  
	</div>
	</br>
	</br>
	</br>
    <section class="services pt-60 pb-60 " id="services">
    <div class="row">
        <div class="col-xl-12">
           <div class="section-title text-center mb-60">
              <p>The best for friends & family</p>
              <h4>My Store</h4>
           </div>
        </div>
     </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
           <div class="single_service service_right">
              <i class="fa fa-truck fa-2x"></i>
              <h4><strong>Free Delivery</strong></h4>
              <p>Free shipping on all orders</p>
           </div>
           <div class="single_service service_right">
            <i class="fa fa-refresh fa-2x"></i>
              <h4><strong>Return Policy</strong></h4>
              <p>Easy return when the product has a problem</p>
           </div>
           <div class="single_service service_right">
            <i class="fa fa-headphones fa-2x"></i>
            <h4><strong>24/7 Support</strong></h4>
              <p>Always ready to answer customers' questions</p>
           </div>
        </div>
        <div class="col-md-4 col-sm-7">
           <div class="single_mid">
              <img src="https://i.pinimg.com/564x/10/00/a1/1000a11f8d75a52b696766c1e8afa4df.jpg" alt="" width="370">
           </div>
        </div>
        <div class="col-md-4 col-sm-12">
           <div class="single_service">
            <i class="fa fa-database fa-2x"></i>             
             <h4><strong>Secure Payment</strong></h4>
              <p>Make sure customers pay safely</p>
           </div>
           <div class="single_service">
            <i class="fa fa-globe fa-2x"></i>
             <h4><strong>Popular Products</strong></h4>
              <p>Includes many types of products at home and abroad</p>
           </div>
           <div class="single_service">
            <i class="fa fa-coffee fa-2x"></i>
              <h4><strong>Comfortable Space</strong></h4>
              <p>Good space for you</p>
           </div>
        </div>
     </div>
    </section>
   
</br>
</br>
</br>
</br>
</br>
<div class="container">
    <div class="row">
        <div class="col-xl-12">
           <div class="section-title text-center mb-60">
              <h4>There are many types of books</h4>
              
           </div>
        </div>
     </div>
    <div class="row">
        <h2 class="zoom">Legal politics</h2>
	
        <div class="col-sm-6">
	<a href="./listproduct.php?type=Legal-politics">
            <div class="img_section">
                <figure><img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTu27xqKfGSBDwHV-ZMJT0xuc5r_eDRTgzzBjJ7OZCjEdz35SOiSvLUXkNkHi3n7xQKAaqEOZT0uXN2r9-c53sIs6E8_2Uyolwz44jo5w&usqp=CAc" width="150"></figure>
            </div>
			</a>
        </div>
	</div>
		<div class="row">
        <h2 class="zoom">Science and Technology - Economy</h2>
	
        <div class="col-sm-6">
	<a href="./listproduct.php?type=Science-and-Technology-Economy">
            <div class="img_section">
                <figure><img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQN17mVDZwkHyiaVvQAbKoaRjNkWttlfHt2nDd8cwK_Y-tbE1WwDRH4DjKe8m6e&usqp=CAc" width="250"></figure>
            </div>
	</a>
        </div>
	
</div>
    <div class="row">
        <h2 class="zoom_in">Art and Literature</h2>
		   
            <div class="col-sm-6">
			<a href="./listproduct.php?type=Art-and-Literature"> 
                <div class="img_section2">
                    <figure><img src="https://shoptretho.com.vn/upload/image/product/20140411/truyen-kieu.jpg" ></figure>
                </div>
				</a>
            </div>
	</div>
	<div class="row">
        <h2 class="zoom_in">Social Culture - History</h2>
            <div class="col-sm-6">
			<a href="./listproduct.php?type=Social-Culture-History"> 
                <div class="img_section2">
                    <figure><img src="https://img1.baza.vn/upload/files/products-sUPlxAn9/qNLgPf8V.JPG?v=635646194667281576"></figure>
                </div>
				</a>
            </div>
        </div>
        <div class="row">
	
            <h2 class="rotate">Psychology, spirituality, religion</h2>
	
                <div class="col-sm-6">
				<a href="./listproduct.php?type=Psychology-spirituality-religion">
                    <div class="img_section4">
                        <figure><img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSAcEbztwAXganswUAB0qSqBOrWMmlGt6IpIxb0MvZQXBuRpkik-OibG6nUpL_bB84XeXqIh93QySvNxyTM7-b7BCHJuS3kwZKzhtocUmelsvWJzBMlV9Q&usqp=CAc" width="200"></figure>
                    </div>
					</a>
                </div>
				</div>
				<div class="row">
            <h2 class="rotate">Children's books</h2>

                <div class="col-sm-6">
				<a href="./listproduct.php?type=Children-books">
                    <div class="img_section4">
                        <figure><img src="https://toquoc.mediacdn.vn/Upload/Article/doanvankhanh/2013/5/31/rez_263_co%20be%20ban%20diem%20copy.jpg" width="300"></figure>
                    </div>
					</a>
                </div>
                
            </div>
        <div class="row">
            <h2 class="slide">Curriculum</h2>
	
            <div class="col-sm-6">
			<a href="./listproduct.php?type=Curriculum">
                <div class="img_section3">
                    <figure><img src="https://cf.shopee.vn/file/0193c645973364a8ef9f073efb7d969c"></figure>
                </div>
				</a>
            </div>  
			
        </div>
        <div class="row">
	
		<h2 class="slide">Novel</h2>
	
            <div class="col-sm-6">
			<a href="./listproduct.php?type=Novel">
                <div class="img_section3">
                    <figure><img src="https://sachxua.vn/wp-content/uploads/2020/01/mac-biet-sach-nta.jpg"></figure>
                </div>
				</a>
            </div>
        </div>
        
 
            
</div>
</div>
<?php include 'footer.php'; ?>