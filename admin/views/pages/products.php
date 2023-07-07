<?php
    global $conn;
    $products = getAllProducts();
    $imgPath = "../assets/img/product/";
?>

<?php if(isset($_GET["success"])): ?>
    <div id="modal" class="modal" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <button type="button" class="btn-close btnCloseDelete float-end " id="updateModal" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body mt-5">
                    <p class="alert alert-success h3">Successfully</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnCloseDelete" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="col-sm-12 col-12 p-3">
    <div class="bg-secondary rounded h-100 p-4 ">
        <h6 class="mb-4 text-center">ADD PRODUCT</h6>
        <div class="w-25 mx-auto">
            <a class="btn btn-success w-100 m-2" href="admin.php?page=addProduct">Add Product</a>
        </div>
    </div>
</div>
<div class="col-12 p-3">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Products</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Brend</th>
                    <th scope="col">Price</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>

                </tr>
                </thead>
                <tbody class="align-middle">
                <?php foreach ($products as $index => $p): ?>
                    <tr id="row-<?= $p->product_id ?>">
                        <th class="text-white" scope="row"><?= $index+1 ?></th>
                        <td class="w-25"><img src="<?=$imgPath . $p->main_img ?>" class="w-50"></td>
                        <td class="text-white"><?= $p->name ?></td>
                        <td class="text-white"><?= $p->brend ?></td>
                        <td class="text-white">$<?= $p->newPrice ?></td>
                        <td><p class="m-0 btn btn-sm btn-danger btnDeleteProduct" data-id="<?= $p->product_id ?>" href="#">Delete</p></td>
                        <td><a class="btn btn-sm btn-primary btnUpdateVehicle" href="admin.php?page=updateProduct&id=<?=$p->product_id?>">Update</a></td>
                    </tr>
                    <?php  endforeach; ?>

                </tbody>
            </table>

        </div>
        <div id="modalDelete"></div>
    </div>
</div>