<?php
$lastOrder = selectAll('product_order',"ORDER BY date DESC LIMIT 1");
$date = date('F j H:m:s',strtotime($lastOrder[0]->date));

$totalMonth = totalSales("MONTH(CURRENT_DATE()) = MONTH(date)");
$totalYear = totalSales("YEAR(CURRENT_DATE()) = YEAR(date)");
$orders = selectAll("product_order");


?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-4">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-around p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Last Order</p>
                    <h6 class="mb-0"><?= $date ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-around p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">This Month</p>
                    <h6 class="mb-0">$ <?= $totalMonth ? $totalMonth : 0?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-around p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">This Year</p>
                    <h6 class="mb-0">$ <?= $totalYear ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Recent Sales</h6>
            <!--<a href="">Show All</a>-->
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                <tr class="text-white text-center h5">
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <!--<th scope="col">Time</th>-->
                    <th scope="col">Email</th>
                    <!--<th scope="col">Time</th>-->
                    <th scope="col">City</th>
                    <th scope="col">Address</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                <?php foreach ($orders as $o): ?>
                    <tr>
                        <td><?= $o->name . " " . $o->last_name ?></td>
                        <td><?= $o->phone ?></td>
                        <td><?= $o->email ?></td>
                        <td><?= $o->city ?></td>
                        <td><?= $o->address ?></td>
                        <td><?= $o->total ?> $</td>
                        <td class="d-flex justify-content-center"><a href="admin.php?page=singleOrder&id=<?=$o->order_id?>" class="alert alert-info mt-2 py-1 w-75">More...</a></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>