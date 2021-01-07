<?php require_once 'init.php';?>
<?php
$order = GetOrderListFinish(); 
$date = date("d/m/Y");
$month = date("n");
$year = date("Y");
$day = Doanhthutheongayht();
$yearo = Doanhthutheonamht();
$montho = Doanhthutheothanght();
$quyo=Doanhthutheoquyht();
if($month >=1 && $month < 4){
    $quy = 1;
}
else if($month >=4 && $month < 7){
    $quy = 2;
}else if($month >=7 && $month < 10){
    $quy = 3;
}else{
    $quy = 4;
}
$index = 0;
?>
<?php include 'adminheader.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                    <p><?php echo 'Date: '. $date?></p>
                                    <p>Total: <?php if($day['total'] == null){echo 0;}else{ echo $day['total'];}?></p>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body"><p><?php echo 'Month: '. $month?></p>
                                    <p>Total: <?php if($montho['total'] == null){echo 0;}else{ echo $montho['total'];}?></p></div>
                                   
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                <div class="card-body"><p><?php echo 'Year: '. $year?></p>
                                    <p>Total: <?php if($yearo['total'] == null){echo 0;}else{ echo $yearo['total'];}?></p></div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                <div class="card-body"><p><?php echo 'Quy: '. $quy.','.$year?></p>
                                    <p>Total: <?php if($quyo['total'] == null){echo 0;}else{ echo $quyo['total'];}?></p></div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Order
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
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php while($order[$index]):?>
                                            <tr>
                                                <td><?php echo $order[$index]['Id']?></td>
                                                <td><?php echo $order[$index]['Name']?></td>
                                                <td><?php echo $order[$index]['CMND']?></td>
                                                <td><?php echo $order[$index]['Tel']?></td>
                                                <td><?php echo $order[$index]['Address']?></td>
                                                <td><?php echo $order[$index]['Total']?></td>
                                                <td><?php echo $order[$index]['Status']?></td>
                                                <td><?php echo $order[$index]['Time']?></td>
                                            </tr>
                                        <?php $index=$index+1;?>
                                        <?php endwhile;?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<?php include 'adminfooter.php'; ?>