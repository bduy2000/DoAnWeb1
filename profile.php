
<?php
require_once 'init.php';
$title = 'Profile';
if (isset($_FILES['Avatar'])) {
	$tmp_name = $_FILES['Avatar']['tmp_name'];
	$NewImage=resizeImage($tmp_name,250,250);
	ob_start(); // Let's start output buffering.
    imagejpeg($NewImage); //This will normally output the image, but because of ob_start(), it won't.
    $contents = ob_get_contents(); //Instead, output above is saved to $contents
	ob_end_clean(); //End the output buffer.
	UpdateAvatar($currentUser['Id'],$contents);
	$load = 1;
}
if(isset($_POST['name']) && $_POST['name'] !=NULL){
	UpdateUserName($currentUser['Id'],$_POST['name']);
	$load = 1;
}
if(isset($_POST['Tel']) && $_POST['Tel'] !=NULL){
	$Tel=$_POST['Tel'];
	$checktel1 =  preg_match('@[A-Z]@', $Tel);
$checktel2 = preg_match('@[a-z]@', $Tel);
$checktel3 = strpbrk($Tel, $illegal);
if($checktel1 || $checktel2 || $checktel3 || strlen($Tel) != 10){
	echo '<div class="alert alert-danger" role="alert">' . 'This is not phone number =,=!' . '</div>';
	$load = 1;
}else{
	UpdateUserTel($currentUser['Id'],$_POST['Tel']);
	$load = 1;
}
}
if(isset($_POST['Address']) && $_POST['Address'] !=NULL){
	UpdateUserAddress($currentUser['Id'],$_POST['Address']);
	$load = 1;
}
?>
<?php
if($load){
	header("Refresh:0");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Open Sans", sans-serif;
        }
        
        .button {
            background-color: #3AC5C9;
            border: none;
            color: white;
            padding: 11px 25px;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer
        }
        
      
        
        .image-container {
            position: relative;
        }
        
        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }
        
        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }
        
        .image-container:hover .image {
            opacity: 0.3;
        }
        
        .image-container:hover .middle {
            opacity: 1;
        }
    </style>

</head>
<?php include 'header.php'; ?>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script language="javascript" src="script.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex bd-highlight">
                                <div class="image-container">
									<?php if(!$currentUser['Avatar']): ?>
                                    <img src="https://ephoto360.com/uploads/effect-data/ephoto360.com/1362b22eb/t5e787cba70ec8.jpg" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
									<?php else:?>
										<?php echo '<img  id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" src="data:image/jpeg;base64,' . base64_encode($currentUser['Avatar']) . '"/>' ?>
									<?php endif;?>	
									<div class="middle">
									<form action="profile.php" method="post">
                                        <input for="file" type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" >
										<input type="file" style="display: none;" id="profilePicture" name="Avatar" accept="image/jpeg"/>
						
									</form>
                                    </div>
                                </div>
                                <div class="p-2 flex-grow-1 bd-highlight">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold; margin: 20px"><a href="javascript:void(0);"><?php echo $currentUser['Name']?></a></h2>
                                </div>
                                <div class="p-2 bd-highlight">
                                    <input type="button" class="btn btn-danger d-none" id="btnDiscard" value="Discard Changes" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="changePassword-tab" data-toggle="tab" href="#changePassword" role="tab" aria-controls="changePassword" aria-selected="false">Password</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">
                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                            <form class="mb-3" action="profile.php" method="post">
                                                <div class="mb-3 col-9">
                                                    <label for="fullname"><h6>Fullname</h6></label>
                                                    <input type="text" class="form-control" name="name" id="fullname" placeholder="<?php echo $currentUser['Name']?>" title="enter your full name if any.">
                                                </div>
                                                <div class="mb-3 col-9">
                                                    <br>
                                                    <label for="Tel"><h6>Tel</h6></label>
                                                    <input type="text" class="form-control" name="Tel" id="Tel" placeholder="<?php echo $currentUser['Tel']?>" title="enter your tel if any.">
                                                </div>
                                                <div class="mb-3 col-9">
                                                    <br>
                                                    <label for="Address"><h6>Address</h6></label>
                                                    <input type="Address" class="form-control" name="Address" id="Address" placeholder="<?php echo $currentUser['Address']?>" title="enter your email.">
                                                </div>
                                                <button class="button" type="submit">Save</button>
                                                <button class="btn btn-lg btn-light" type="reset">Cancel</button>
                                            </form>
                                        </div>

                                        <div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab">
                                            <form class="mb-3" action="changepassword.php" method="post">
                                                <div class="mb-3 col-9">
                                                    <label for="oldpassword"><h6>Old Password</h6></label>
                                                    <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="enter password">
                                                </div>
                                                <div class="mb-3 col-9">
                                                    <br>
                                                    <label for="password"><h6>New Password</h6></label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="enter password">
                                                </div>
                                                <div class="mb-3 col-9">
                                                    <br>
                                                    <label for="confirmpassword"><h6>Confirm Password</h6></label>
                                                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="verify password">
                                                </div>
                                                <button class="button" type="submit">Save</button>
                                                <button class="btn btn-lg btn-light" type="reset">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>