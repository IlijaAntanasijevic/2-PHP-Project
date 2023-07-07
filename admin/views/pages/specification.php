<?php
    $brends = selectAll("brend");
?>

<div class="container">
    <div class="bg-secondary rounded p-4 mt-5">
        <p>Specifications</p>
        <div class="row " id="specContainer">
            <div class="col">
                <form>
                    <div class="row text-center justify-content-center flex-column  align-items-center">
                        <div class="col-12">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Brand</label>
                                <input type="text" class="form-text  text-dark border-0 p-2" id="brandName" placeholder="Add Brand..."/>
                                    <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-around">
                                <p class="btn btn-success mt-5 w-100" id="addBrandBnt">Submit</p>
                            </div>
                            <p class="text-success ia-error">Successfully added</p>

                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row text-center justify-content-center flex-column  align-items-center">
                        <div class="col-12">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Color</label>
                                <input type="text" class="form-text  text-dark border-0 p-2" id="colorName" placeholder="Add Color..."/>
                                    <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-around">
                                <p class="btn btn-success mt-5 w-100" id="addColorBnt">Submit</p>
                            </div>
                            <p class="text-success ia-error">Successfully added</p>

                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row text-center justify-content-center flex-column  align-items-center">
                        <div class="col-12">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Category</label>
                                <input type="text" class="form-text  text-dark border-0 p-2" id="categoryName" placeholder="Add Category..."/>
                                    <p class="text-danger ia-error"></p>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-around">
                                <p class="btn btn-success mt-5 w-100" id="addCategoryBtn">Submit</p>
                            </div>
                            <p class="text-success ia-error">Successfully added</p>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <div class="d-flex">
                <p class="btn btn-primary" id="specBrend">Brand</p>
                <p class="btn btn-primary mx-3" id="specColor">Color</p>
                <p class="btn btn-primary" id="specCat">Category</p>
            </div>
            <div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-white" id="specificationsPreview">
                        <?php foreach ($brends as $index=>$b): ?>
                            <tr id="<?= "row-".$b->brend_id ?>">
                                <td><?= $index+1 ?></td>
                                <td ><?= $b->name ?></td>
                                <td><a href="#" class="btn btn-danger deleteSpec" data-type="brend" id="<?= $b->brend_id ?>">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modalSpec"></div>
