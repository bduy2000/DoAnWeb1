<?php
require_once 'init.php';
$id = $_GET['id'];
$getproductdetail = findproductbyId($id);
?>

<?php
$index = 1;
if(isset($_POST['submit'])){
if(isset($_POST['name'])){
    RenameProduct($_POST['name'] , $id);
}
if(isset($_POST['type'])){
    ReTypeProduct($_POST['type'],$id);
}
if(isset($_POST['Price'])){
    RePriceProduct($_POST['Price'],$id);
}
if(isset($_POST['Quantity'])){
    ReQuantityProduct($_POST['Quantity'],$id);
}
if(isset($_POST['Decription'])){
    ReDecriptonProduct($_POST['Decription'],$id);
}
if(isset($_POST['Status'])){
    ReStatusProduct($_POST['Status'],$id);
}
if(isset($_FILES['MainAvatar'])){
    $tmp_name = $_FILES['MainAvatar']['tmp_name'];
    $Av=resizeImage($tmp_name,500,500);
    ob_start(); // Let's start output buffering.
    imagejpeg($Av); //This will normally output the image, but because of ob_start(), it won't.
    $data = ob_get_contents(); //Instead, output above is saved to $contents
    ob_end_clean();
    ReAvatarProduct($data,$id);
}
if(isset($_FILES['listavatar'])){
    $countfiles = count($_FILES['listavatar']['name']);
    $a = array();
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
    RePictureProduct($a,$id,$getproductdetail);
}
header("Refresh:0");
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
	<title> Edit</title>
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
        
   
        .dropdown {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.06)) repeat scroll 0 0 #F2F2F2;
    border-color: #FFFFFF #F7F7F7 #F5F5F5;
    border-image: none;
    border-radius: 3px;
    border-style: solid;
    border-width: 1px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.08);
    display: inline-block;
    height: 28px;
    overflow: hidden;
    position: relative;
    width: 150px;
}

.dropdown:before {
    border-bottom-style: solid;
    border-top: medium none;
}
.dropdown:after {
    border-bottom: medium none;
    border-top-style: solid;
    margin-top: 7px;
}
.dropdown-select {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
    border: 0 none;
    border-radius: 0;
    color: #62717A;
    font-size: 12px;
    height: 28px;
    line-height: 14px;
    margin: 0;
    padding: 6px 8px 6px 10px;
    position: relative;
    text-shadow: 0 1px #FFFFFF;
    width: 130%;
}
.dropdown-select:focus {
    color: #394349;
    outline: 2px solid #49AFF2;
    outline-offset: -2px;
    width: 100%;
    z-index: 3;
}


.wrapper {
            margin: 20% auto;
            width: 60%;
        }
        
        #displayImg {
            margin-top: 30px;
        }
        
        #displayImg img {
            height: 50px;
            margin-right: 15px;
            display: inline-block;
        }


	</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>

<body>


	<div class="container-contact100">
  
		<div class="wrap-contact100">
        <a type="button" href="index.php">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/>
</svg> BACK
    </a>
			<form action="editproduct.php?id=<?php echo $id?>"  class="contact100-form validate-form" method="POST" enctype="multipart/form-data"> 
				<span class="contact100-form-title" style="color: #3AC5C9; font-weight: bold;">
					Product
				</span>
                <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" >
					<span  class="label-input100">Product ID*</span>
					<input class="input100" type="text" name="proid" placeholder="<?php echo $getproductdetail['Id'] ?>" disabled>
				</div>
                <span  class="label-input100">Type of book:</span>
                <div style="height: 30px;width: 300px" class="dropdown dropdown">
                    <select  name="typeofbook" class="dropdown-select">
                    <option value="Legal-politics" selected><?php echo $getproductdetail['Type'] ?></option>
                      <option value="Legal-politics">Legal politics</option>
                      <option value="Science-and-Technology-Economy">Science and Technology - Economy</option>
                      <option value="Art-and-Literature">Art and Literature</option>
                      <option value="Social-Culture-History">Social Culture - History</option>
                      <option value="Psychology-spirituality-religion">Psychology, spirituality, religion</option>
                      <option value="Children-books">Children's books</option>
                      <option value="Curriculum">Curriculum</option>
                      <option value="Novel">Novel</option>
                    </select>
              </div>
				<div class="wrap-input100 validate-input bg1">
					<span class="label-input100">Product Name*</span>
					<input class="input100" type="text" name="name" value="<?php echo $getproductdetail['Name'] ?>" placeholder="<?php echo $getproductdetail['Name'] ?>">
				</div>
				<div class="wrap-input100 validate-input bg1">
					<span class="label-input100">Price*</span>
					<input class="input100" type="number" name="Price" value="<?php echo $getproductdetail['Price'] ?>" placeholder="<?php echo $getproductdetail['Price'] ?>">
				</div>
                <div class="wrap-input100 validate-input bg1">
					<span class="label-input100">Number*</span>
					<input class="input100" type="number" name="Quantity" value="<?php echo $getproductdetail['StoreQuantity']?>" placeholder="<?php echo $getproductdetail['StoreQuatity']?>">
				</div>

				<div class="wrap-input100 validate-input bg0 rs1-alert-validate">
					<span class="label-input100">Product Description</span>
					<textarea class="input100" name="Decription"  placeholder="<?php echo $getproductdetail['Decription']?>"><?php echo $getproductdetail['Decription']?></textarea>
				</div>
        

				<div class="wrap-input validate-input bg0 rs1-alert-validate">
				<span class="label-input100">Avatar For Product</span>
						<?php echo	'<img src="data:image/jpeg;base64,' . base64_encode($getproductdetail['Avatar0']) . '" style="width:200px;height:200px;display: block; margin-left: auto; margin-right: auto" id="output" />'?>
					<input type="file" class="form-control-file" name="MainAvatar" accept="image/jpeg"
						onchange="loadFile(event)" require>
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
<br />
                    <div class="wrap-input100 validate-input bg0 rs1-alert-validate">
                        <span class="label-input100">Images For Product</span>
                        <center>
                        <table width="270px" cellspacing="0px" cellpadding="0px" border="1px"> 
                            <tr>
                            <?php while($getproductdetail['Avatar'.$index]):?>
                                <td> <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($getproductdetail['Avatar'.$index]).'" alt="Lỗi"  style="width:86px;height:81px;"></td>'?>
                                <?php $index = $index+1;?>
                                <?php endwhile;?>
                            </tr> 
                        </table>
                        </center>
                            <input type="file" name="listavatar[]" id="upload" accept="image/jpeg" onchange="ImagesFileAsURL()" multiple />
                            <div id="displayImg">
                    
                            </div>
                            <script type="text/javascript">
                                function ImagesFileAsURL() {
                                    var fileSelected = document.getElementById('upload').files;
                                    if (fileSelected.length > 0) {
                                        for (var i = 0; i < fileSelected.length; i++) {
                                            var fileToLoad = fileSelected[i];
                                            var fileReader = new FileReader();
                                            fileReader.onload = function(fileLoaderEvent) {
                                                var srcData = fileLoaderEvent.target.result;
                                                var newImage = document.createElement('img');
                                                newImage.src = srcData;
                                                document.getElementById('displayImg').innerHTML += newImage.outerHTML;
                                            }
                                            fileReader.readAsDataURL(fileToLoad);
                                        }
                    
                                    }
                                }
                            </script>
                    </div>
                    
                    <div class="custom-control custom-radio custom-control-inline">
                    <?php if($getproductdetail['Status'] == 'Favorite'):?>
                        <input type="radio" class="custom-control-input" value="Favorite" name="Status" checked>
                        <?php else:?>
                            <input type="radio" class="custom-control-input" value="Favorite" name="Status">
                        <?php endif;?>
                        <label class="custom-control-label" for="defaultInlineNam">Favorite</label>
                        
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                    <?php if($getproductdetail['Status'] == 'New'):?>
                        <input type="radio" class="custom-control-input" value="New" name="Status" checked>
                        <?php else:?>
                            <input type="radio" class="custom-control-input" value="New" name="Status">
                        <?php endif;?>
                        <label class="custom-control-label" for="defaultInlineNu">New</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                    <?php if($getproductdetail['Status'] == 'Best Sale'):?>
                        <input type="radio" class="custom-control-input" value="Best Sale" name="Status" checked>
                        <?php else:?>
                            <input type="radio" class="custom-control-input" value="Best Sale" name="Status">
                        <?php endif;?>
                        <label class="custom-control-label" for="defaultInlineNu">Best Sale</label>
                    </div>
                    <div class="container-contact100-form-btn">
                        <button class="contact100-form-btn" type="submit" name="submit">
                            <span>
                                Submit
                            </span>
                        </button>
                    </div>
			
            </div>
        </div>



				


			</form>
		</div>
	</div>



</body>
</html>