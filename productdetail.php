<?php
require_once 'init.php';
$id = $_GET['id'];

$getproductdetail = findproductbyId($id);
$loadcomment = loadcomment($id);
$i = 0;
$iload = 0;


if(isset($_POST['favorite'])){
    if($currentUser){
        if($_POST['favorite'] == 'unlike'){
        Unlike($currentUser['Id'],$getproductdetail);
        header("Refresh:0");
    }else{
        Like($currentUser['Id'],$getproductdetail);
        header("Refresh:0");
    }}
    else{
        $error = 'You must login to save favoriteproduct';
    }
}




if(isset($_POST['soluong']) ){
    if($currentUser){
        $soluong1 = $_POST['soluong'];
        $soluong=(int)$soluong1;
        if($soluong > 999){
            $error = 'ban nhap so qua cao :<';
        }
        else{
            $hihi = getbag($getproductdetail['Id'],$currentUser['Id'],$soluong,$getproductdetail['Price']);
            if($hihi == 1){
                header("Refresh:0");
                
            }else {
                $error = 'So luong ton khong du  :<';
            }

            
            
        }

    }else{       
         $error = 'You must login to buy';

    }
}
if(isset($_POST['comment']) || isset($_FILES['postImage'])){
    if($currentUser){
        if(isset($_FILES['postImage'])){
            $tmp_name = $_FILES['postImage']['tmp_name'];
	$NewImage=resizeImage($tmp_name,250,250);
	ob_start(); // Let's start output buffering.
    imagejpeg($NewImage); //This will normally output the image, but because of ob_start(), it won't.
    $new = ob_get_contents(); //Instead, output above is saved to $new
    ob_end_clean(); //End the output buffer.
        }
       
        AddComment($currentUser['Id'],$id,$_POST['comment'],$new);
        header("Refresh:0");
    }else{
        $error = 'You must login to comment';
    }
}
?>



<?php include 'header.php'; ?>
<?php if ($error): ?>
<div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
</div>
<?php endif;?>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styleproductdetail.css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  
    <style>
        * {
            font-family: "Open Sans", sans-serif;
        }
        .clicked {
  fill: #ff0000;
}
.unclicked{
    fill: #000000;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">
                            <script language="javascript" src="scriptproductdetail.js"></script>
                            <div class="preview-pic">
                            <?php echo '<img id="expandedImg" src="data:image/jpeg;base64,' . base64_encode($getproductdetail['Avatar0']) . '" class="img-responsive img-fluid" alt="">'?>
                             
                            </div>
                            <div class="preview-thumbnail row">
                                <?php while ($getproductdetail['Avatar'.$i]):?>
                                <div class="col ">
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($getproductdetail['Avatar'.$i]).'" onclick="myFunction(this)" />'?>
                                </div>
                                <?php $i = $i +1;?>
                                <?php endwhile;?>
                            </div>
                        </div>
                        <div class="details col-md-6">
                            <h3 class="product-title"><?php echo $getproductdetail['Name']?></h3>
                            <?php $loai=str_replace("-"," ",$getproductdetail['Type']);?>
                            <div class="details col-md-6">
                          
                            <br>
                            <div class="rating">
                                <div class="stars">
                                <?php if ($getproductdetail['Like'] > 5000):?>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <?php else:?>
                                <?php $star1 = $getproductdetail['Like']/1000;
                                $star = (int)$star1;
                                $nostar = 5 - $star;
                                ?>
                                <?php while($star>=1):?>
                                <span class="fa fa-star checked"></span>
                                <?php $star = $star-1;?>
                                <?php endwhile;?>
                                <?php while($nostar >= 1):?>
                                <span class="fa fa-star"></span>
                                <?php $nostar = $nostar-1;?>
                                <?php endwhile;?>
                                <?php endif;?>
                                </div>
                            </div>
                            <p class="product-description">Like: <?php echo $getproductdetail['Like']?></p>
                            <p class="product-description"><?php echo $loai?></p>
                            <h4 class="price">current price: <span><?php echo $getproductdetail['Price']?> VND</span></h4>
                        </div>
                        <form name="form" action="productdetail.php?id=<?php echo $id?>" method="post">
                            <div class="section" style="padding-bottom:20px;">
                                <h6 class="title-attr">Amount: </h6>
                                <br>
                                <div>
                               
                                    <div class="btn-minus"><span class="fa fa-minus"></span></div>
                                   
                                    <input type="number" name="soluong" value="1" />
                                 
                                    <div class="btn-plus"><span class="fa fa-plus"></span></div>
                                  
                                </div>
                            </div>
                            <div class="action">
                           <button type="submit"  class="add-to-cart btn btn-default"  >Add to Cart</button>
                        </form>
                    
                           </br>
                        <form action="productdetail.php?id=<?php echo $id?>" method="post">
                        <input type="hidden" id="favorite" name="favorite" value="<?php if($currentUser && CheckProductIsUserFavorite($getproductdetail['Id'],$currentUser['Id'])){echo 'unlike';} else{ echo'like';}  ?>">
                        <button for="favorite" class="add-to-cart btn btn-default"  >
                               <?php if($currentUser && CheckProductIsUserFavorite($getproductdetail['Id'],$currentUser['Id'])):?>
                                DisLike 
                                <?php else:?>
                                    Like
                                    <?php endif;?>
                                    </button>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <ul class="menu-items"> Detail </ul>
                <div style="width:100%; border-top:1px solid silver">
                    <p style="padding:15px;">
                        <small>
                               <?php echo $getproductdetail['Decription']?>
                        </small>
                    </p>
                </div>
            </div>
            <div class="row">
                <ul class="menu-items"> Comment</ul>
                <div style="width:100%; border-top:1px solid silver">
                    <div class="widget-area">
                        <div class="status-upload">
                            <form action="productdetail.php?id=<?php echo $getproductdetail['Id'] ?>" method="post" enctype="multipart/form-data">
                                <textarea placeholder="What's your comment?" name="comment"></textarea>
                                
                                <input type="file" class="form-control-file" id="postImage" name="postImage" accept="image/jpeg" onchange="loadFile(event)">
                                <img  id="output" />
                                <script>
                                    var loadFile = function(event) {
                                        var output = document.getElementById('output');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                        output.onload = function() {
                                            URL.revokeObjectURL(output.src) // free memory
                                        }
                                    };
                                </script>
                                <button type="submit" class="btn btn-success" style="background-color: #3AC5C9"><i class="fa fa-share"></i> Share</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php while($loadcomment[$iload]):?>
                <div class="row">
                    
                    <div class="col-sm-2">
                        <div class="thumbnail">
                            <?php if($loadcomment[$iload]['Avatar']): ?>
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($loadcomment[$iload]['Avatar']) . '" class="img-responsive user-photo" alt="">'?>
                            <?php else:?>
                            <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong><?php echo $loadcomment[$iload]['Name']?></strong> <span class="text-muted">commented at <?php echo $loadcomment[$iload]['Time'] ?></span>
                            </div>
                            <div class="panel-body">
                                <?php echo $loadcomment[$iload]['Content']?>
                                </br>
                                <?php if($loadcomment[$iload]['image']):?>
                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($loadcomment[$iload]['image']) . '"  alt="">'?>
                                <?php endif;?>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php $iload = $iload+1;?>
                <?php endwhile;?>
            </div>
        </div>
    
</div>