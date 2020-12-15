<?php
require_once 'init.php';
?>

<?php
if(isset($_POST['name']) && isset($_POST['Price']) && isset($_POST['Quantity']) && isset($_POST['Decription']) && isset($_POST['Status']) && isset($_FILES['MainAvatar']))
{
var_dump($_FILES['listavatar']);
    $Name = $_POST['name'];
    $Price = $_POST['Price'];
    $Quantity = $_POST['Quantity'];
    $Decription = $_POST['Decription'];
    $Status = $_POST['Status'];
    $tmp_name = $_FILES['MainAvatar']['tmp_name'];
    $countfiles = count($_FILES['listavatar']['name']);
    $illegal = "~`!@#$%^&*()_-+={[]}:;'<>?/,.\|";
    $checkprice1 =  preg_match('@[A-Z]@', $Price);
    $checkprice2 = preg_match('@[a-z]@', $Price);
    $checkprice3 = strpbrk($Price, $illegal);
    $checkquantity1 =  preg_match('@[A-Z]@', $Quantity);
    $checkquantity2 = preg_match('@[a-z]@', $Quantity);
    $checkquantity3 = strpbrk($Quantity, $illegal);
    if($countfiles > 9){
        $erro = 'Limit 9 pictures ;< ';
    }else if($checkprice1 || $checkprice2 || $checkprice3){
        $erro='This price is not number ;<';
    }else if($checkquantity1 || $checkquantity2 || $checkquantity3){
        $erro='This quantity is not number ;<';
    }else if ($Price > 100000000 || $Price < 0 || $Quantity > 100000000 || $Quantity < 0){
      $erro='The number is very lagre or negative number ;<';
    }else{
      $data = file_get_contents($tmp_name);
  $a = array($data);
  $i = 0;
  while($i < $countfiles){
    $v=$_FILES['listavatar']['tmp_name'][$i];
    $NewImage=resizeImage($v,500,500);
	ob_start(); // Let's start output buffering.
    imagejpeg($NewImage); //This will normally output the image, but because of ob_start(), it won't.
    $contents = ob_get_contents(); //Instead, output above is saved to $contents
	ob_end_clean(); //End the output buffer.
    array_push($a,$contents);
    $i=$i+1;
  }
$id = GetMaxProductId();
if($id == null){
  $id = 0;
}else{
  $id = $id +1;
}
//AddProduct($id,$Name,$Price,$Quantity,$Decription,$Status,$a);
    }
}
?>
<?php if (isset($error)): ?>
<div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
</div>
<?php endif;?>

 
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Insert</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


	<style type="text/css">
		.anh
		{
			margin-right: 10px;
			width:200px;
			float:left;
			
		}
		.wrap {
            margin: 10% auto;
            width: 60%;
        }
        
        .dandev-reviews {
            position: relative;
            margin: 20px 0;
        }
        
        .dandev-reviews .form_upload {
            width: 320px;
            position: relative;
            padding: 5px;
            bottom: 0px;
            height: 40px;
            left: 0;
            z-index: 5;
            box-sizing: border-box;
            background: #f7f7f7;
            border-top: 1px solid #ddd;
        }
        
        .dandev-reviews .form_upload>label {
            height: 35px;
            width: 160px;
            display: block;
            cursor: pointer;
        }
        
        .dandev-reviews .form_upload label span {
            padding-left: 26px;
            display: inline-block;
            background: url(images/camera.png) no-repeat;
            background-size: 23px 20px;
            margin: 5px 0 0 10px;
        }
        
        .list_attach {
            display: block;
            margin-top: 30px;
        }
        
        ul.dandev_attach_view {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        ul.dandev_attach_view li {
            float: left;
            width: 80px;
            margin: 0 20px 20px 0 !important;
            padding: 0!important;
            border: 0!important;
            overflow: inherit;
            clear: none;
        }
        
        ul.dandev_attach_view .img-wrap {
            position: relative;
        }
        
        ul.dandev_attach_view .img-wrap .close {
            position: absolute;
            right: -10px;
            top: -10px;
            background: #000;
            color: #fff!important;
            border-radius: 50%;
            z-index: 2;
            display: block;
            width: 20px;
            height: 20px;
            font-size: 16px;
            text-align: center;
            line-height: 18px;
            cursor: pointer!important;
            opacity: 1!important;
            text-shadow: none;
        }
        
        ul.dandev_attach_view li.li_file_hide {
            opacity: 0;
            visibility: visible;
            width: 0!important;
            height: 0!important;
            overflow: hidden;
            margin: 0!important;
        }
        
        ul.dandev_attach_view .img-wrap-box {
            position: relative;
            overflow: hidden;
            padding-top: 100%;
            height: auto;
            background-position: 50% 50%;
            background-size: cover;
        }
        
        .img-wrap-box img {
            right: 0;
            width: 100%!important;
            height: 100%!important;
            bottom: 0;
            left: 0;
            top: 0;
            position: absolute;
            object-position: 50% 50%;
            object-fit: cover;
            transition: all .5s linear;
            -moz-transition: all .5s linear;
            -webkit-transition: all .5s linear;
            -ms-transition: all .5s linear;
        }
        
        ul li,
        ol li {
            list-style-position: inside;
        }
        
        .list_attach span.dandev_insert_attach {
            width: 80px;
            height: 80px;
            text-align: center;
            display: inline-block;
            border: 2px dashed #ccc;
            line-height: 76px;
            font-size: 25px;
            color: #ccc;
            display: none;
            cursor: pointer;
            float: left;
        }
        
        ul.dandev_attach_view {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        ul.dandev_attach_view .img-wrap {
            position: relative;
        }
        
        .list_attach.show-btn span.dandev_insert_attach {
            display: block;
            margin: 0 0 20px!important;
        }
        
        i.dandev-plus {
            font-style: normal;
            font-weight: 900;
            font-size: 35px;
            line-height: 1;
        }
        
        ul.dandev_attach_view li input {
            display: none;
        }

	</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form action=""  class="contact100-form validate-form" method="POST" enctype="multipart/form-data"> 
				<span class="contact100-form-title" style="color: #3AC5C9; font-weight: bold;">
					Product
				</span>
				<div class="wrap-input100 validate-input bg1">
					<span class="label-input100">Product Name*</span>
					<input class="input100" type="text" name="name" placeholder="Please Enter Product Type">
				</div>
				<div class="wrap-input100 validate-input bg1">
					<span class="label-input100">Price*</span>
					<input class="input100" type="number" name="Price" placeholder="0-100.000.000">
				</div>
                <div class="wrap-input100 validate-input bg1">
					<span class="label-input100">Number*</span>
					<input class="input100" type="number" name="Quantity" >
				</div>

				<div class="wrap-input100 validate-input bg0 rs1-alert-validate">
					<span class="label-input100">Product Description</span>
					<textarea class="input100" name="Decription" placeholder="Please describe product including size, origin,... "></textarea>
				</div>
        

				<div class="wrap-input validate-input bg0 rs1-alert-validate">
				<span class="label-input100">Avatar For Product</span>
							<img style="width:200px;height:200px;display: block; margin-left: auto; margin-right: auto" id="output" />
				
				
					<input type="file" class="form-control-file" name="MainAvatar" accept="image/jpeg"
						onchange="loadFile(event)" >
      
					<script>
						
					var loadFile = function(event) 
					{
						var output = document.getElementById('output');
						output.src = URL.createObjectURL(event.target.files[0]);
						output.onload = function() {
							URL.revokeObjectURL(output.src) // free memory
						}
					};
					</script>
					</div>
          <input id="upload_files"  name="listavatar[]" type="file" class="form-control-file"  accept="image/jpeg" multiple >
          <div class="image_uploading hidden">
        <label> </label>
        <img src="image_upload_status.gif" alt="Image Uploading......"/>
        <div id="images_preview"></div>		
    </div>
	</form>
	<div id="images_preview"></div>	
					<script>
					$(document).ready(function(){
    $('#upload_files').on('change',function(){
        $('#image_upload_form').ajaxForm({           
            target:'#images_preview',
            beforeSubmit:function(e){
                $('.image_uploading').show();
            },
            success:function(e){
                $('.image_uploading').hide();
            },
            error:function(e){
            }
        }).submit();
    });
});
          </script>
					

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						<span>
							Submit
						</span>
					</button>
				</div>
        <div class="form-check">
  <input class="form-check-input" type="radio" name="Status" id="Favorite" value="Favorite" checked>
  <label class="form-check-label" for="Favorite">
    Favorite
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="Status" id="New" value="New">
  <label class="form-check-label" for="New">
    New
  </label>
  </div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="Status" id="Best sale" value="Best sale">
  <label class="form-check-label" for="admin">
    Best sale
  </label>
  </div>
			</form>
		</div>
	</div>



</body>
</html>