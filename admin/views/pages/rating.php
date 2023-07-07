<?php
    global $conn;
    $products = selectAll("product");

?>

<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
        <div class="bg-secondary rounded p-4">
            <h6 class="mb-4">Reviews</h6>
            <h6 class="alert-danger w-50 mx-auto text-center py-2 ia-error" id="limit">You can display at least 3 comments</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th><i class="fa fa-star"></i>(5)</th>
                        <th><i class="fa fa-star"></i>(4)</th>
                        <th><i class="fa fa-star"></i>(3)</th>
                        <th><i class="fa fa-star"></i>(2)</th>
                        <th><i class="fa fa-star"></i>(1)</th>
                        <th>Total<i class="fa fa-star"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($products as $p):
                            $addWhere = "WHERE product_id = $p->product_id";
                            $reviews = selectAll("rating",$addWhere);
                            $overall = 0;
                            $query = "SELECT COUNT(*) as totalReviews,SUM(rating) as sum FROM rating WHERE product_id = $p->product_id";
                            $select = $conn->query($query);
                            $result = $select->fetch();
                            $sum = (int)$result->sum;
                            $totalReviews = $result->totalReviews;
                            if($totalReviews){
                                $overall = $sum / $totalReviews;
                                $overall = round($overall,1);
                            }


                    ?>
                        <tr>
                            <td><a href="admin.php?page=updateProduct&id=<?= $p->product_id ?>"><?= $p->name ?></a></td>

                            <td><?= getNumberOfStars(5,$p->product_id); ?></td>
                            <td><?= getNumberOfStars(4,$p->product_id); ?></td>
                            <td><?= getNumberOfStars(3,$p->product_id); ?></td>
                            <td><?= getNumberOfStars(2,$p->product_id); ?></td>
                            <td><?= getNumberOfStars(1,$p->product_id); ?></td>
                            <td><?= $overall ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
