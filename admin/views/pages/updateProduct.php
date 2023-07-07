<?php

    if(isset($_GET["id"])){
        define("imgPath","../assets/img/product/");
        $productID = $_GET["id"];
        if(!is_numeric($productID)){
            die("Server Error");
        }
        $product = selectAll("product"," WHERE product_id = $productID")[0];
        $price = selectAll("price", "WHERE product_id = $productID ORDER BY date DESC LIMIT 1")[0];
        $price = $price->price;
        $gender = selectAll('gender');
        $category = selectAll('category');
        $brand = selectAll("brend");
        $color = selectAll("color");
    }
    else {
        die("Server Error");
    }
?>


   <div class="col-sm-12 col-12 p-3">
        <div class="bg-secondary rounded h-100 p-4 ">
           <div class="container">
               <form action="" method="post" enctype="multipart/form-data">
                   <div class="row text-center">
                   <div class="col-3">
                       <div class="d-flex flex-column">
                           <label for="" class="form-label">Name</label>
                           <input type="text" value="<?=$product->name?>" class="form-text text-dark border-0 p-2" id="updateProductName"/>
                           <p class="text-danger ia-error"></p>

                       </div>
                   </div>
                   <div class="col-7">
                       <div class="d-flex flex-column">
                           <label for="" class="form-label">Description</label>
                           <textarea type="text" rows="3" class="form-text  text-dark border-0 p-2" id="updateDescription"><?=$product->description?></textarea>
                           <p class="text-danger ia-error"></p>

                       </div>
                   </div>
                   <div class="col-2">
                       <div class="d-flex flex-column">
                           <?php printDropDownList("Gender","ddlGenderUpdate",$gender,$product,'gender_id'); ?>
                           <p class="text-danger ia-error"></p>

                       </div>
                   </div>
                   <div class="row my-5">
                       <div class="col-4">
                           <div class="d-flex flex-column">
                               <?php printDropDownList("Category","ddlCatUpdate",$category,$product,'category_id'); ?>
                               <p class="text-danger ia-error"></p>

                           </div>
                       </div>
                       <div class="col-4">
                           <div class="d-flex flex-column">
                               <?php printDropDownList("Brend","ddlBrendUpdate",$brand,$product,'brend_id'); ?>
                               <p class="text-danger ia-error"></p>

                           </div>
                       </div>
                       <div class="col-4">
                           <div class="d-flex flex-column">
                               <?php printDropDownList("Color","ddlColorUpdate",$color,$product,'color_id'); ?>
                               <p class="text-danger ia-error"></p>

                           </div>
                       </div>
                   </div>
               </div>
                   <div class="row align-items-center mt-5 flex-column">
                       <img src="<?=imgPath . $product->main_img ?>" alt="<?= $product->name?>" class="w-25 mb-4" height="200px">
                       <input type="file" class="w-25 mb-5" id="imageUpdate"/>
                       <p class="text-danger ia-error"></p>

                   </div>
                   <div class="row justify-content-center">
                       <div class="col-5">
                           <div class="d-flex flex-column">
                               <label for="" class="form-label fs-3 mt-5 text-center">Price($)</label>
                               <input type="text" value="<?=$price?>" class="form-text fs-2 text-dark border-0 p-2" id="priceUpdate">
                               <p class="text-danger ia-error"></p>

                           </div>
                       </div>
                   </div>
                   <div class="row justify-content-center">
                       <div class="col-6">
                           <div class="d-flex justify-content-around">
                               <input type="hidden" value="<?= $productID ?>" id="updateProductID">
                               <a href="admin.php?page=products" class="btn btn-danger mt-5 ">Cancel</a>
                               <a href="#" class="btn btn-success mt-5 px-5" id="updateProduct">Submit</a>
                           </div>
                       </div>
                   </div>
               </form>
           </div>
        </div>
    </div>
