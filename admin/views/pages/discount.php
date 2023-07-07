<?php
    $products = selectAll("product");
    $addQuery = "INNER JOIN product p ON p.product_id = d.product_id WHERE d.date_to > CURDATE()";
    $disc = selectAll("discount d", $addQuery);
?>

<div class="col-sm-12 col-12 p-3">
    <div class="bg-secondary rounded h-100 p-4 ">
        <div class="container">
            <form method="post" enctype="multipart/form-data">
                <div class="row text-center justify-content-center">
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <label for="" class="form-label">Date To</label>
                            <input type="date" class="form-text  text-dark border-0 p-2" id="dateToDisc" />
                            <p class="text-danger ia-error"></p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex flex-column">
                            <label for="" class="form-label">Value (%)</label>
                            <input type="number" placeholder="1-100" class="form-text text-dark border-0 p-2" id="percentageDisc" />
                            <p class="text-danger ia-error"></p>
                        </div>
                    </div>
                    <div class="row text-center justify-content-center mt-5">
                        <div class="col-6">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Product</label>
                                <select class="form-control" id="productDisc">
                                    <option value="0">Choose...</option>
                                    <?php foreach ($products as $p): ?>
                                        <option value="<?= $p->product_id ?>"><?= $p->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger ia-error"></p>

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-column">
                                <p class="btn btn-success" id="addDisc" style="margin-top: 35px; cursor: pointer">Submit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="container">
            <?php if(count($disc)): ?>
            <table class="table table-hover">
                <thead>
                    <th>Product</th>
                    <th>Date To</th>
                    <th>Value(%)</th>
                </thead>
                <tbody>
                    <?php foreach ($disc as $d): ?>
                        <tr>
                            <td><?= $d->name ?></td>
                            <td><?= $d->date_to ?></td>
                            <td><?= $d->value ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>
