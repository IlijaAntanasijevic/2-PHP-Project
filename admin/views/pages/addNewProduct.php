<?php
    $gender = selectAll('gender');
    $category = selectAll('category');
    $brand = selectAll("brend");
    $color = selectAll("color");

?>
<div id="successModal" class="ia-error">

<div id="modal" class="modal" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <button type="button" class="btn-close btnCloseDelete float-end " id="updateModal" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body mt-5">
                <p class="alert alert-success h4">Successfully entered into the database</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btnCloseDelete" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
  <div class="col-sm-12 col-12 p-3">
        <div class="bg-secondary rounded h-100 p-4 ">
            <div class="container">
                <form method="post" enctype="multipart/form-data">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" class="form-text  text-dark border-0 p-2" id="addProductName" name="addProductName"/>
                                <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Gender</label>
                                <select name="ddlGender" id="ddlGender" class="form-control">
                                    <option value="0">Choose...</option>
                                    <?php foreach($gender as $g): ?>
                                        <option class="text-dark" value="<?= $g->gender_id ?>"><?= $g->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Quantity</label>
                                <input type="number" id="addQuantity" class="form-text  text-dark border-0 p-2" name="addQuantity"/>
                                <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Price($)</label>
                                <input type="number" id="addPrice" class="form-text  text-dark border-0 p-2" name="addPrice"/>
                                <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center my-5">
                        <div class="col-12">
                            <label for="" class="form-label">Description</label>
                            <textarea type="text" id="description" rows="3" class="form-text w-100 text-dark border-0 p-2" name="AddDescription"></textarea>
                            <p class="text-danger ia-error"></p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-3">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Brend</label>
                                <select name="ddlBrend" id="ddlBrend" class="form-control">
                                    <option value="0">Choose...</option>
                                    <?php foreach($brand as $b): ?>
                                    <option class="text-dark" value="<?= $b->brend_id ?>"><?= $b->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Category</label>
                                <select name="ddlCategory" id="ddlCategory" class="form-control">
                                    <option value="0">Choose...</option>
                                    <?php foreach($category as $c): ?>
                                        <option class="text-dark" value="<?= $c->category_id ?>"><?= $c->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Color</label>
                                <select name="ddlColor" id="ddlColor" class="form-control">
                                    <option value="0">Choose...</option>
                                    <?php foreach($color as $c): ?>
                                        <option class="text-dark" value="<?= $c->color_id ?>"><?= $c->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Choose Image</label>
                            <input type="file" name="addImage" id="addImage" class="form-control"/>
                            <p class="text-danger ia-error"></p>
                        </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-6">
                            <div class="d-flex justify-content-around">
                                <p id="addBtn" class="btn btn-success mt-5 w-100" name="addBtn">Submit</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

