<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Do An Web</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <?php if ($currentUser): ?>
                        <?php if ($currentUser['Category']=='customer' ): ?>
                        <li class="nav-item">
                        <a class="nav-link"  href="listfavoriteproduct.php">Your Favorite Product</a>
                    </li>
                    <?php endif; ?>
					<li class="nav-item">
                        <a class="nav-link"  href="profile.php">Your Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="changepassword.php">Change Password</a>
                    </li>
                    <?php if ($currentUser['Category']=="admin" ): ?>
                    <li class="nav-item">
                        <a class="nav-link"  href="addproduct.php">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="admindashboard.php">Dashboard Admin</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link"  href="logout.php">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <?php endif; ?>
        </ul>
        <div>
        </div> 
  </nav>
 