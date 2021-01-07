<?php require_once 'init.php';?>
<?php $product = getAllProduct();
$index = 0;
if(isset($_POST['remove'])){
    DelProduct($_POST['remove']);
    header("Refresh:0");
}
?>
<?php include 'adminheader.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Book</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashbroadadmin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"> Book</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Book
                                <a type="button" href="addproduct.php" class="btn btn-success">Add new book</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Like</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Like</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php while($product[$index]):?>
                                            <tr>
                                                <td><?php echo $product[$index]['Id']?></td>
                                                <td><?php echo $product[$index]['Name']?></td>
                                                <td><?php echo $product[$index]['Type']?></td>
                                                <td><?php echo $product[$index]['Like']?></td>
                                                <td><?php echo $product[$index]['Price']?></td>
                                                <td><?php echo $product[$index]['StoreQuantity']?></td>
                                                <td><?php echo $product[$index]['Status']?></td>
                                                <td><form action="listproducttable.php" method="post">
                                                <input type="hidden" name="remove" value="<?php echo $product[$index]['Id']?>">
                                                <button type ="submit" value="submit" class="btn btn-danger" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg>
                                                </button>
                                                <a type = "button" href="editproduct.php?id=<?php echo $product[$index]['Id']?>" class="btn btn-info" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
  <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
</svg></a>
                                                </form>
                                                
                                                </td>
                                        
                                            </tr>
                                        <?php $index=$index+1;?>
                                        <?php endwhile;?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<?php include 'adminfooter.php'; ?>