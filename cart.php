<?php
require_once 'init.php';
$bag = UserBag($currentUser['Id']);
$Total = 0;
$i = 0;
if(isset($_POST['removeproduct'])){
    DelBagItem($_POST['removeproduct'],$currentUser['Id']);
    header("Refresh:0");
}
if(isset($_POST['soluong'])){
    $a = $_POST['soluong'];
    var_dump($a);
}
?>

<!DOCTYPE html>
<head>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
}

    </style>
</head>

<?php include 'header.php'; ?>
</br>
</br>
</br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" style="font-size:20px"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="font-size:20px"> Bag</li>
  </ol>
  </br>

</nav>
</br>
</br>

<div class="container">
<h1>Your Bag</h1>
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while($bag[$i]):?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="./productdetail.php?id=<?php echo $bag[$i]['Id']?>"> <?php echo'<img class="media-object" src="data:image/jpeg;base64,' . base64_encode($bag[$i]['Avatar0']) . '" style="width: 72px; height: 72px;">'?> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="./productdetail.php?id=<?php echo $bag[$i]['Id']?>"><?php echo $bag[$i]['Name']?></a></h4>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                       
                        <label type="number" name="soluong" class="form-control" id="quantity" > <?php echo $bag[$i]['Quantity']?> </label>
                       
                        
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $bag[$i]['Price'] ?></strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $bag[$i]['Total'] ?></strong></td>
                        <td class="col-sm-1 col-md-1">
                        <form action="cart.php" method="post"> 
                        <button type="submit" class="btn btn-danger" name="removeproduct" value="<?php echo $bag[$i]['Id'] ?>">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button></td>
                        </form>
                        
                    </tr>
                    <?php $Total = $Total + $bag[$i]['Total'] ?>
                   <?php $i = $i +1;?>
                    <?php endwhile;?>
                    <tr>
                        
                        <td />
                        <td />
                        <td />
                 
                 
      
           
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong><?php echo $Total . 'D';?></strong></h3></td>
                    </tr>
                    <tr>
                        <td />
                    <td />
                    <td />
                        <td>
                        <a href="./index.php" type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </a></td>
                        <td>
                        <button type="button"  onclick="dieu_huong()" class="btn btn-info">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button></td>

                        <script>
                            function dieu_huong(){
                                location.assign("pay.php");
                            }
                        </script>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<form action="cart.php" method="post">
<input type="hidden" name="Quantity" value="">
<input type="hidden" name="ProductId" value="">
<input type="hidden" name="Remove" id="removep" value="">
</form>

</body>
</html>