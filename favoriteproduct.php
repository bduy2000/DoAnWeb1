<?php
require_once 'init.php';
?>
<?php include 'header.php'; ?>

    <style type="text/css">
    .products {
   list-style-type: none;
   
}


.products li {
   display: block;
   float: left;
   width: 225px; 
   text-align: center; 
}

nput {
  outline: none;
}
input[type=search] {
  -webkit-appearance: textfield;
  -webkit-box-sizing: content-box;
  font-family: inherit;
  font-size: 100%;
}
input::-webkit-search-decoration,
input::-webkit-search-cancel-button {
  display: none; 
}



input:-moz-placeholder {
  color: #999;
}
input::-webkit-input-placeholder {
  color: #999;
}


#demo-2 input[type=search] {
  width: 15px;
  padding-left: 10px;
  color: transparent;
  cursor: pointer;
}
#demo-2 input[type=search]:hover {
  background-color: #fff;
}
#demo-2 input[type=search]:focus {
  width: 130px;
  padding-left: 32px;
  color: #000;
  background-color: #fff;
  cursor: auto;
}
#demo-2 input:-moz-placeholder {
  color: transparent;
}
#demo-2 input::-webkit-input-placeholder {
  color: transparent;
}


	</style>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
</br>
</br>
</br>
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Your favorite</li>
  </ol>
</nav>

	<div class="container-contact100">
		<div class="wrap-contact100">

				<span class="contact100-form-title" style="color:#3ac5c9; font-weight: bold; font-size:30px;">List of favorite products </span>
             <br />
                <div>
                <ul class="products">
                    <li>
                    
                     <a href=".." target="_self"> 
                          <img style="width:200px;height:200px;display: block; margin-left: auto; margin-right: auto" src="https://choibongro.vn/wp-content/uploads/2019/10/GIAY-BONG-RO-NIKE-KYRIE-LOW-2-9.jpeg"  alt="...">

                          <span style="color:black; font-weight: bold;font-size:15px ">Kyrie Nike Low:</span>
                          <span style="color:black; font-weight: bold;font-size:15px ">  3.000.000</span>
                       </a>
                       
                    </li>
                    <li>
                     <a href=".." target="_self"> 
                     <img style="width:200px;height:200px;display: block; margin-left: auto; margin-right: auto" src="https://image.yes24.vn/Upload/ProductImage/GmarketJew/2002040_L.jpg" alt="...">
                          <span style="color:black; font-weight: bold;font-size:15px">Kyrie:</span>
                          <span style="color:black; font-weight: bold;font-size:15px">1.000.000</span>
                       </a>

                    </li>
           
                 </ul>
               </div>
               

		</div>
	</div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>