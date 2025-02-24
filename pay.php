
<?php require_once 'init.php';
if($currentUser == NULL) {
    header('Location:index.php');
}
?>

<?php 


$bag = UserBag($currentUser['Id']);
if(count($bag) == 0){
    header('Location:index.php');
}
$total = 0;
$index = 0;
if(isset($_POST['cmnd'])&& isset($_POST['address']) && $_POST['tel']){
    $id1 = GetMaxOrderId();
$id=(int)$id1;
    if($id1 == null){
        $id = 0;
    }else{
        $id=(int)$id1;
        $id = $id+1;
    }
    while($bag[$index]){
        $total=$total + $bag[$index]['Total'];
         $index = $index +1;
      }
    AddListOder($_POST['address'],$_POST['tel'],$_POST['cmnd'],$bag,$id,$currentUser['Id'],$total);
    header("Refresh:0");
}

?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<head>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<!------ Include the above in your HEAD tag ---------->
<style>
    body { -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; font-family: 'Noto Sans', sans-serif; letter-spacing: 0px; font-size: 14px; color: #2e3139; font-weight: 400; line-height: 26px; }
h1, h2, h3, h4, h5, h6 { letter-spacing: 0px; font-weight: 400; color: #1c1e22; margin: 0px 0px 15px 0px; font-family: 'Noto Sans', sans-serif; }
h1 { font-size: 42px; line-height: 50px; }
h2 { font-size: 36px; line-height: 42px; }
h3 { font-size: 20px; line-height: 32px; }
h4 { font-size: 18px; line-height: 32px; }
h5 { font-size: 14px; line-height: 20px; }
h6 { font-size: 12px; line-height: 18px; }
p { margin: 0 0 20px; line-height: 1.8; }
p:last-child { margin: 0px; }
ul, ol { }
a { text-decoration: none; color: #2e3139; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; transition: all 0.3s; }
a:focus, a:hover { text-decoration: none; color: #49AFF2; }
.content{padding-top:80px; padding-bottom:80px};


/*------------------------
Radio & Checkbox CSS
-------------------------*/
.form-control { border-radius: 4px; font-size: 14px; font-weight: 500; width: 100%; height: 70px; padding: 14px 18px; line-height: 1.42857143; border: 1px solid #dfe2e7; background-color: #dfe2e7; text-transform: capitalize; letter-spacing: 0px; margin-bottom: 16px; -webkit-box-shadow: inset 0 0px 0px rgba(0, 0, 0, .075); box-shadow: inset 0 0px 0px rgba(0, 0, 0, .075); -webkit-appearance: none; }

input[type=radio].with-font, input[type=checkbox].with-font { border: 0; clip: rect(0 0 0 0); height: 1px; margin: -1px; overflow: hidden; padding: 0; position: absolute; width: 1px; }
input[type=radio].with-font~label:before, input[type=checkbox].with-font~label:before { font-family: FontAwesome; display: inline-block; content: "\f1db"; letter-spacing: 10px; font-size: 1.2em; color: #dfe2e7; width: 1.4em; }
input[type=radio].with-font:checked~label:before, input[type=checkbox].with-font:checked~label:before { content: "\f00c"; font-size: 1.2em; color: #49AFF2; letter-spacing: 5px; }
input[type=checkbox].with-font~label:before { content: "\f096"; }
input[type=checkbox].with-font:checked~label:before { content: "\f046"; color: #49AFF2; }
input[type=radio].with-font:focus~label:before, input[type=checkbox].with-font:focus~label:before, input[type=radio].with-font:focus~label, input[type=checkbox].with-font:focus~label { }

.box { background-color: #fff; border-radius: 8px; border: 2px solid #e9ebef; padding: 50px; margin-bottom: 40px; }
.box-title { margin-bottom: 30px; text-transform: uppercase; font-size: 16px; font-weight: 700; color: #49AFF2; letter-spacing: 2px; }
.plan-selection { border-bottom: 2px solid #e9ebef; padding-bottom: 25px; margin-bottom: 35px; }
.plan-selection:last-child { border-bottom: 0px; margin-bottom: 0px; padding-bottom: 0px; }
.plan-data { position: relative; }
.plan-data label { font-size: 20px; margin-bottom: 15px; font-weight: 400; }
.plan-text { padding-left: 35px; }
.plan-price { position: absolute; right: 0px; color: #49AFF2; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 1.5; bottom: 43px; }
.term-price { bottom: 18px; }
.secure-price { bottom: 68px; }
.summary-block { border-bottom: 2px solid #d7d9de; }
.summary-block:last-child { border-bottom: 0px; }
.summary-content { padding: 28px 0px; }
.summary-price { color: #49AFF2; font-size: 20px; font-weight: 400; letter-spacing: -1px; margin-bottom: 0px; display: inline-block; float: right; }
.summary-small-text { font-weight: 700; font-size: 12px; color: #8f929a; }
.summary-text { margin-bottom: -10px; }
.summary-title { font-weight: 700; font-size: 14px; color: #1c1e22; }
.summary-head { display: inline-block; width: 120px; }

.widget { margin-bottom: 30px; background-color: #e9ebef; padding: 50px; border-radius: 6px; }
.widget:last-child { border-bottom: 0px; }
.widget-title { color: #49AFF2; font-size: 16px; font-weight: 700; text-transform: uppercase; margin-bottom: 25px; letter-spacing: 1px; display: table; line-height: 1; }

.btn { font-family: 'Noto Sans', sans-serif; font-size: 16px; text-transform: capitalize; font-weight: 700; padding: 12px 36px; border-radius: 4px; line-height: 2; letter-spacing: 0px; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; transition: all 0.3s; word-wrap: break-word; white-space: normal !important;color:#49AFF2 }
.btn-default { background-color: #49AFF2; color: #fff; border: 1px solid #49AFF2; }
.btn-default:hover { background-color: #49AFF2; color: #fff; border: 1px solid #49AFF2; }
.btn-default.focus, .btn-default:focus { background-color: #49AFF2; color: #fff; border: 1px solid #49AFF2; }


span.price {
  float: right;
  color: grey;
}
    </style>
</head>
<body>

   
        

<div class="content">
<div class="container">
	 <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                    <div class="box">
                        <h3 class="box-title">Shipment Details</h3>
                        <form action="pay.php" method="post">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                </div>
                                <input type="text" class="form-control" id="nombre" name="nameuser" placeholder="<?php echo $currentUser['Name']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                </div>
                                <input type="text" class="form-control" id="nombre" name="cmnd" placeholder="CMND" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-phone text-info"></i></div>
                                </div>
                                <input type="tel" name="tel" class="form-control" placeholder="XXXX-XXXX" required></input>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-address-card text-info"></i></div>
                                </div> 
                                <textarea class="form-control" name="address" placeholder="Your Address" required></textarea>
                            </div>
                        </div>
                        <center>  <button style="color:#49AFF2" class="btn ">Pay </button> </center>
                        </form>
                        

                    </div>
                   
                    
                    
         
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                  
                    <div class="widget">
                        <div>
                        <h4 class="widget-title">Order Summary
                        <span class="price" style="color:black">
                            <i class="fa fa-shopping-cart"></i>

                          </span>
                          </h4>
                          <?php while($bag[$index]): ?>
                          <p><a href="./productdetail?id=<?php echo $bag[$index]['productid']?>"><?php echo $bag[$index]['Name'] ?></a> <span class="price"><?php echo $bag[$index]['Total']?></span></p>
                          <?php $total=$total + $bag[$index]['Total'];?>
                          <?php $index = $index +1; ?>
                          <?php endwhile;?>
                          <hr>
                      <b>    <p style="font-size:30px">Total <span class="price" style="font-size:30px"><b><?php echo $total ?></b></span></p> </b>
                    </div>
                   
                </div>
            </div>


</body>
</html>