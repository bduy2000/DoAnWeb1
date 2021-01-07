

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<style >

 
  
 .navbar  {
          
         
          font-size:20px;
       
      }
      .dropdown {
  background: transparent;
  width: 70px;
  padding: 5px;
}
.dropdown-menu>li>a {
  
  font-size:12px;
}
.dropdown ul.dropdown-menu {
  border-radius:4px;
  box-shadow:none;
  margin-top:20px;
  width:150px;
  
}
.dropdown ul.dropdown-menu:before {
  content: "";
  border-bottom: 10px solid #fff;
  border-right: 10px solid transparent;
  border-left: 10px solid transparent;
  position: absolute;
  top: -10px;
  right: 16px;
  z-index: 10;
}
.dropdown ul.dropdown-menu:after {
  content: "";
  border-bottom: 12px solid #ccc;
  border-right: 12px solid transparent;
  border-left: 12px solid transparent;
  position: absolute;
  top: -12px;
  right: 14px;
  z-index: 9;
  
}


    </style>
</head>
<body >
  <nav class="navbar navbar-expand-lg navbar-dark mb-8" style="background-color:#3ac5c9;" >
        <a class="navbar-brand" href="index.php">
            <img src="https://www.flaticon.com/svg/static/icons/svg/869/869636.svg" alt="" width="45" height="45" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
            </li>   
            </ul>
            <form class="form-inline my-2 my-lg-0" action="listproduct.php?search=<?php echo $_POST['search'] ?>">
                <input class="form-control mr-sm-3" type="search" placeholder="Search" aria-label="Search" name="search" onchange="this.form.submit()">
            </form>    
            
            <ul class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="white" class="bi bi-person" viewBox="0 0 16 16"><path fill-rule="none" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/></svg>
                </a>
                <ul class="dropdown-menu">
                <?php if ($currentUser): ?>
                <li class="divider"></li>
                    <li style="font-size:20;" ><a href="profile.php">Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php">Log Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    <?php else: ?>
                    <li class="divider"></li>
                    <li><a href="login.php">Log In <span class="glyphicon glyphicon-user pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="register.php">Register<span class="glyphicon glyphicon-user pull-right"></span></a></li>
                    <?php endif;?>
                </ul>
            </ul>
                    <a href="listproduct.php?type=Userfavorite" class="mr-sm-3" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="white" class="bi bi-suit-heart" viewBox="0 0 16 16"><path fill-rule="none" d="M8 6.236l.894-1.789c.222-.443.607-1.08 1.152-1.595C10.582 2.345 11.224 2 12 2c1.676 0 3 1.326 3 2.92 0 1.211-.554 2.066-1.868 3.37-.337.334-.721.695-1.146 1.093C10.878 10.423 9.5 11.717 8 13.447c-1.5-1.73-2.878-3.024-3.986-4.064-.425-.398-.81-.76-1.146-1.093C1.554 6.986 1 6.131 1 4.92 1 3.326 2.324 2 4 2c.776 0 1.418.345 1.954.852.545.515.93 1.152 1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/></svg>
                    </a>    
                    <a href="cart.php" class="mr-sm-3" >
                <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="white" class="bi bi-archive" viewBox="0 0 16 16" ><path fill-rule="none"   d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/></svg>
                    </a>
                    
            </div>
        
    </nav>
</body>
    