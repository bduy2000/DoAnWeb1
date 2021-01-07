<?php require_once 'init.php';?>
<?php $listorder = GetOrderList();
$index = 0;
if(isset($_POST['status'])){
    $status = $_POST['status'];
    $pieces = explode("-", $status);
    UpdateStatusOrder($pieces[0],$pieces[1]);
    header("Refresh:0");
}
?>
<?php include 'adminheader.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Order List</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashbroadadmin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"> Order List</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                List Order
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>UserName</th>
                                                <th>CMND</th>
                                                <th>Tel</th>
                                                <th>Address</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Update Status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>UserName</th>
                                                <th>CMND</th>
                                                <th>Tel</th>
                                                <th>Address</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Update Status</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php while($listorder[$index]):?>
                                            <tr>
                                                <td><?php echo $listorder[$index]['Id']?></td>
                                                <td><?php echo $listorder[$index]['Name']?></td>
                                                <td><?php echo $listorder[$index]['CMND']?></td>
                                                <td><?php echo $listorder[$index]['Tel']?></td>
                                                <td><?php echo $listorder[$index]['Address']?></td>
                                                <td><?php echo $listorder[$index]['Total']?></td>
                                                <td><?php echo $listorder[$index]['Status']?></td>
                                                <td><?php echo $listorder[$index]['Time']?></td>
                                                <td>
                                                <form id="formsubmit" action="listorder.php" method="post">
                                                <select onchange="this.form.submit()" name="status" class="form-select" aria-label="Default select example">
                                                <option value="pending-<?php echo $listorder[$index]['Status']?>" selected><?php echo $listorder[$index]['Status'] ?></option>
                                                <option value="pending-<?php echo $listorder[$index]['Id']?>">pending</option>
                                                <option value="processing-<?php echo $listorder[$index]['Id']?>">processing</option>
                                                <option value="shipping-<?php echo $listorder[$index]['Id']?>">shipping</option>
                                                <option value="finish-<?php echo $listorder[$index]['Id']?>">finish</option>
                                                <option value="drop-<?php echo $listorder[$index]['Id']?>">drop</option>
</select>
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