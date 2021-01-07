<?php require_once 'init.php';?>
<?php $customers = GetCustomerList();
$index = 0;
?>
<?php include 'adminheader.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Customer List</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashbroadadmin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"> Customer List</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                List Customer
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Tel</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Tel</th>
                                                <th>Address</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php while($customers[$index]):?>
                                            <tr>
                                                <td><?php echo $customers[$index]['Name']?></td>
                                                <td><?php echo $customers[$index]['Email']?></td>
                                                <td><?php echo $customers[$index]['Tel']?></td>
                                                <td><?php echo $customers[$index]['Address']?></td>
                                                
                                            </tr>
                                        <?php $index=$index+1;?>
                                        <?php endwhile;?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<?php include 'adminfooter.php'; ?>