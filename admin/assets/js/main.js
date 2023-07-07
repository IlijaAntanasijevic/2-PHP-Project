(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });


    // Progress Bar
    $('.pg-bar').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});


    // Calender
    $('#calender').datetimepicker({
        inline: true,
        format: 'L'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
        nav : false
    });


    // Chart Global Color
    Chart.defaults.color = "#6C7293";
    Chart.defaults.borderColor = "#000000";


    
})(jQuery);

/****MOJ JS****/
/*
$.ajax({
    url: "../logic/getAll.php",
    method: "get",
    data : {table: "vehicle"},
    success: function (res){
        localStorage.setItem("cars",JSON.stringify(res))
    },
    error: function (xhr){
        alert("Ajax Error");
        console.log(xhr);
    }
})

 */
$('#addBtn').click(function (){
    let productName = $('#addProductName');
    let gender = $('#ddlGender');
    let quantity = $('#addQuantity').val();
    let price = $('#addPrice');
    let description = $('#description');
    let brend = $('#ddlBrend');
    let category = $('#ddlCategory');
    let color =$('#ddlColor');
    let image = $('#addImage');
    let errors = 0;

    let error = validationFormProduct(productName,gender,price,description,brend,category,color,image);

    if(!quantity){
        $('#addQuantity').next().show().html("Quantity is required");
        error = true;
    }
    else if(isNaN(quantity)){
        $('#addQuantity').next().show().html("Invalid quantity");
        error = true;
    }
    else {
        $('#addQuantity').next().hide().html("");
    }

    if(!error){
        let imageFormat = image[0].files[0]
        let data = new FormData();
        data.append("name",productName.val());
        data.append("genderID",gender.val());
        data.append("quantity",quantity);
        data.append("price",price.val());
        data.append("description",description.val());
        data.append("brendID",brend.val());
        data.append("categoryID",category.val());
        data.append("colorID",color.val());
        data.append("image",imageFormat);
        ajaxCallbackImg("models/add-product.php","post",data,function (res){
            console.log(res);
            $('#successModal').show();
        })
    }
})

$(document).on("click",".btnDeleteProduct",function () {
    let id = $(this).data('id');
    printModal("Message","Are you sure you want to delete.");

    $('#confirm').click(() => {
        $('#modalDelete').html("");
        $.ajax({
            url : "models/deleteProduct.php",
            method: "POST",
            data: { id: id },
            success: function(res) {
                $("#row-" + id).remove()
            },
            error : function (xhr){
                console.log(xhr);
            }
        })
    })
})

$(document).on("click","#updateProduct",function (e){
    e.preventDefault();
    let name = $('#updateProductName');
    let gender = $('#ddlGenderUpdate');
    let price = $('#priceUpdate');
    let description = $('#updateDescription');
    let brend = $('#ddlBrendUpdate');
    let category = $('#ddlCatUpdate');
    let color =$('#ddlColorUpdate');
    let image = $('#imageUpdate');


    let error = validationFormProduct(name,gender,price,description,brend,category,color,image);

    if(!error){
        let imageFormat = image[0].files[0]
        let productID  = $('#updateProductID').val();
        let data = new FormData();
        data.append("name",name.val());
        data.append("genderID",gender.val());
        data.append("price",price.val());
        data.append("description",description.val());
        data.append("brendID",brend.val());
        data.append("categoryID",category.val());
        data.append("colorID",color.val());
        data.append("productID",productID);
        data.append("image",imageFormat);
        ajaxCallbackImg("models/updateProduct.php","POST",data,function (res) {
            window.location.replace("admin.php?page=products&success=1");

        })
    }
})


$('.btnCloseDelete').click(() => {
    $('#modal').css('display','none');
})

$(document).on('click','.hideReview',function (){
    let id = $(this)[0].id;
    hideShowReview(id);

})

let regexSpec = /^[A-Za-z]|[\d]{1,20}(\s[A-Za-z]|[\d])?$/;
let reColor = /^[A-z]{1,15}$/;

$('#addBrandBnt').click(function (){
    let name = $('#brandName').val();
    let error = false;
    if(!name){
        $('#brandName').next().html("Brand is required");
        $('#brandName').next().show();
        error = true;
    }
    else if(!regexSpec.test(name)){
        $('#brandName').next().html("Incorrect brand name");
        $('#brandName').next().show();
        error = true;

    }
    else {
        $('#brandName').next().html("");
        $('#brandName').next().hide();
        error = false;
    }
    if(!error){
        let obj = {
            name : name,
            type: "brend"
        }
        ajaxCallback("models/addSpecifications.php",obj,"POST",true,function (res){
            $('#addBrandBnt').parent().next().show();
        })
    }
})

$('#addColorBnt').click(function (){
    let name = $('#colorName').val();
    let error = false;
    if(!name){
        $('#colorName').next().html("Color is required");
        $('#colorName').next().show();
        error = true;
    }
    else if(!reColor.test(name)){
        $('#colorName').next().html("Incorrect color name");
        $('#colorName').next().show();
        error = true;

    }
    else {
        $('#colorName').next().html("");
        $('#colorName').next().hide();
        error = false;
    }
    if(!error){
        let obj = {
            name : name,
            type: "color"
        }
        ajaxCallback("models/addSpecifications.php",obj,"POST",true,function (res){
            $('#addColorBnt').parent().next().show();

        })
    }
})

$('#addCategoryBtn').click(function (){
    let name = $('#categoryName').val();
    let error = false;
    if(!name){
        $('#categoryName').next().html("Category is required");
        $('#categoryName').next().show();
        error = true;
    }
    else {
        $('#colorName').next().html("");
        $('#colorName').next().hide();
        error = false;
    }
    if(!error){
        let obj = {
            name : name,
            type: "category"
        }
        ajaxCallback("models/addSpecifications.php",obj,"POST",true,function (res){
            $('#addCategoryBtn').parent().next().show();

        })
    }
})

$(document).on("click","#specBrend",function (){
    let data = {
        type: "brend"
    }
    ajaxCallback("models/getAll.php",data,"POST",true,function (res){
        printSpecifications(res);
    })
})

$(document).on("click","#specColor",function (){
    let data = {
        type: "color"
    }
    ajaxCallback("models/getAll.php",data,"POST",true,function (res){
        printSpecifications(res);

    })
})

$(document).on("click","#specCat",function (){
    let data = {
        type: "category"
    }
    ajaxCallback("models/getAll.php",data,"POST",true,function (res){
        printSpecifications(res);

    })
})

//#region block/unblock
$(document).on("click",'.blockUser',function (){
    let idUser = this.id;
    let obj = {
        id: idUser,
        action: "block"
    }
    ajaxCallback("models/usersAction.php",obj,"POST",false,function (data, textStatus, xhr){
        if(xhr.status != 200){
            $('#usersErrorMessage').html(JSON.parse(data));
            $('#usersErrorMessage').show();
        }
        else {
            $('#'+idUser).removeAttr("class",'');
            $('#'+idUser).addClass('btn btn-success m-0 unblockUser').html("Unblock")
            $('#usersErrorMessage').html('');
            $('#usersErrorMessage').hide();
        }

    })
})

$(document).on("click",".unblockUser",function (){
    let idUser = this.id;
    let obj = {
        id: idUser,
        action: "unblock"
    }
    ajaxCallback("models/usersAction.php",obj,"POST",false,function (data, textStatus, xhr){
        console.log(xhr.status)
        if(xhr.status == 200){
            $('#'+idUser).removeAttr("class",'');
            $('#'+idUser).addClass('btn btn-danger m-0 blockUser').html("Block")
            $('#usersErrorMessage').html('');
            $('#usersErrorMessage').hide();
        }
        else {
            $('#usersErrorMessage').html('Server error, try again');
            $('#usersErrorMessage').show();
        }
    })
})

//#endregion

$(document).on("click",'.deleteSpec',function (e){
    e.preventDefault();
    let type = $(this).data('type');
    let idToDelete = this.id;
    let data = {
        type: type,
        id : idToDelete
    }
    ajaxCallback("models/deleteSpecification.php",data,"POST",true,function (res){
        if (res.includes("use")){
            basicModelPrint("Message","In use, cannot be deleted!","#modalSpec");
        }
        else if (res.includes("success")){
            basicModelPrint("Message","Deleted successfully","#modalSpec");
            console.log($("#row-" + idToDelete));
            $("#row-" + idToDelete).remove();
        }
    })
})

//DISCOUNT
$(document).on("click","#addDisc",function (){
    let date = $('#dateToDisc').val();
    let value = $('#percentageDisc').val();
    let product = $('#productDisc').val();
    let isValid = true;

    if(value < 1 || value > 100){
        $('#percentageDisc').next().html("Invalid value");
        $('#percentageDisc').next().show();
        isValid = false;
    }
    else {
        $('#percentageDisc').next().html("");
        $('#percentageDisc').next().hide();
    }
    if(product == 0){
        $('#productDisc').next().html("Product is required");
        $('#productDisc').next().show();
        isValid = false;

    }
    else {
        $('#productDisc').next().html("");
        $('#productDisc').next().hide();
    }
    if(isValid){
        let obj = {
            date: date,
            value: value,
            productID : product
        }
        ajaxCallback("models/addDiscount.php",obj,"POST",true,function (res){
            location.reload();
        })
    }
})
function hideShowReview(id){
    $.ajax({
        url : "hideReviews.php",
        data : {id : id},
        method : "post",
        dataType: "json",
        success : function (res){
            console.log(res);
            if (res == 1){
                let string = `<p class="btn btn-success hideReview" id = "${id}">Show</p>`;
                $('#actionRev-'+ id).html(string);
                $('#limit').addClass('ia-error');
            }
            else if (res == 0) {
                let string = `<p class="btn btn-danger hideReview" id = "${id}">Hide</p>`;
                $('#actionRev-'+ id).html(string);
                $('#limit').addClass('ia-error');
            }
            else {
                $('#limit').removeClass('ia-error');
            }
        },
        error : function (xhr){
            alert("GRESKA");
            console.log(xhr)
        }
    })
}

function printSpecifications(spec){
    let string = '';
    let number = 1;
    for(let s of spec){
        string += ` <tr id="row-${s.id}">
                      <td>${number++}</td>
                      <td >${s.name}</td>
                      <td><a href="#" class="btn btn-danger deleteSpec" data-type="${s.type}" id="${s.id}">Delete</a></td>
                      </tr>`;
    }
    $('#specificationsPreview').html(string);
}
function ajaxCallback(url,data,method,returnData=true,result){
    if(returnData){
        $.ajax({
            url: url,
            data : data,
            method : method,
            dataType : "json",
            success: function (res){
                result(res);
            },
            error : function (xhr){
                alert("AJAX ERR");
                console.log(xhr);
            }

        })
    }
    else {
        $.ajax({
            url: url,
            data : data,
            method : method,
            success: function (data, textStatus, xhr){
                result(data, textStatus, xhr);
            },
            error : function (xhr){
                alert("AJAX ERR");
                console.log(xhr);
            }

        })
    }
}

function ajaxCallbackImg(url, method, data, result){
    data = data == 0 ? "" : data;
    let ajaxObj = {
        url: url,
        method: method,
        data: data,
        dataType: "json",
        processData: false,
        contentType: false,
        success: result,
        error: function(xhr) {
            console.log(xhr)
        },
    };

    $.ajax(ajaxObj);

}
function printModal(title,text){
    let string = `<div id="modal" class="modal" tabindex="-1">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-dark">${title}</h5>
                        <button type="button" class="btn-close btnCloseDelete" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p class="text-dark h3">${text}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnCloseDelete" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="confirm"  class="btn btn-primary">Yes</button>
                      </div>
                    </div>
                  </div>
                </div>`;
    $('#modalDelete').html(string);

    $('.btnCloseDelete').click(() => {
        $('#modal').css('display','none');

    })
}

function basicModelPrint(title,text,div="#modalDelete"){

    let string = `<div id="modal" class="modal" tabindex="-1">
                  <div class="modal-dialog ">
                  
                    <div class="modal-content">
                      <div class="modal-body">
                    <h3 class="mb-0 text-dark">${title}</h3>
                      
                        <button type="button" id="updateModal" class="btn-close btnCloseDelete mb-3" data-bs-dismiss="modal" aria-label="Close"></button>
                        <p class="text-dark h3 mt-5">${text}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary btnCloseDelete" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>`;
    $(div).html(string);
    $('.btnCloseDelete').click(() => {
        $('#modal').css('display','none');
    })
}

function printMessages(messages){
    let string = "";

    for (let m of messages){
        string += `
    <div class="my-3 pt-4 border-top ">
        <div class="row h4">
            <div class="col-4">
                <p class="text-center text-light">Name</p>
                <p class="text-center">${m.name}</p>
            </div>
            <div class="col-4">
                <p class="text-center text-light">Email</p>
                <p class="text-center">${m.email}</>
            </div>
            <div class="col-4">
                <p class="text-center text-light">Date</p>`;

                    let date = m.date.split(" ");
                    date = date[0].split("-");
                    date = date[0] + "-" + date[1] + "-" + date[2];
                string += `<p class="text-center">${date}</p>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12">
                <p class="text-center h4">Subject</p>
                <p class="text-white text-center pt-0 px-3 pb-3">${m.subject}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-center h4" ">Message</p>
                <p class="text-white p-3 border border-light m-2">${m.text}</p>
            </div>
        </div>
    </div>`;
    }
    $('#mess').html(string);
}

/*
function validationFormProduct(...tags){
    console.log(tags);
    for(let t of tags){
        console.log(t);
    }
    if(!productName){
        $('#addProductName').next().show().html("Name is required");
        errors++;
    }
    else {
        $('#addProductName').next().hide().html("");
        //----
    }
    if(!description){
        $('#description').next().show().html("Description is required");
        errors++;
    }
    else {
        $('#description').next().hide().html("");
    }

    if(genderID == 0){
        $('#ddlGender').next().show().html("Gender is required");
        errors++;
    }
    else if(isNaN(genderID)){
        $('#ddlGender').next().show().html("Invalid gender type");
        errors++;
    }
    else {
        $('#ddlGender').next().hide().html("");

    }
    if(!quantity){
        $('#addQuantity').next().show().html("Quantity is required");
        errors++
    }
    else if(isNaN(quantity)){
        $('#addQuantity').next().show().html("Invalid quantity");
        errors++
    }
    else {
        $('#addQuantity').next().hide().html("");
    }
    if(!price){
        $('#addPrice').next().show().html("Price is required");
        errors++
    }
    else if(isNaN(price)){
        $('#addPrice').next().show().html("Invalid price");
        errors++
    }
    else {
        $('#addPrice').next().hide().html("");
    }
    if(brendID == 0){
        $('#ddlBrend').next().show().html("Brend is required");
        errors++
    }
    else if(isNaN(brendID)){
        $('#ddlBrend').next().show().html("Invalid brend type");
        errors++
    }
    else {
        $('#ddlBrend').next().hide().html("");
    }
    if(categoryID == 0){
        $('#ddlCategory').next().show().html("Category is required");
        errors++
    }
    else if(isNaN(categoryID)){
        $('#ddlCategory').next().show().html("Invalid category type");
        errors++
    }
    else {
        $('#ddlCategory').next().hide().html("");
    }
    if(colorID == 0){
        $('#ddlColor').next().show().html("Color is required");
        errors++
    }
    else if(isNaN(colorID)){
        $('#ddlColor').next().show().html("Invalid color type");
        errors++
    }
    else {
        $('#ddlColor').next().hide().html("");
    }
    if(image == undefined){
        $('#addImage').next().show().html("Image is required")

    }
    else if (!allowedFormats.includes(image.type)) {
        $('#addImage').next().show().html("Please upload an image in JPG, JPEG, or PNG format")
    }
    else if (image.size > maxSize) {
        $('#addImage').next().show().html("The image size exceeds the maximum limit of 2MB.")

    }
    else{
        $('#addImage').next().hide().html("")

    }
}
*/


function validationFormProduct(name,gender,price,description,brend,category,color,image){
    let errors = 0;
    let imageFormat = image[0].files[0]
    const allowedFormats = ['image/jpeg', 'image/jpg', 'image/png'];
    const maxSize = 2 * 1024 * 1024; // 2MB

    if(!name.val()){
        name.next().show().html("Name is required");
        errors++;
    }
    else {
        $(name).next().hide().html("");
        //----
    }
    if(!description.val()){
        description.next().show().html("Description is required");
        errors++;
    }
    else {
        description.next().hide().html("");
    }

    if(gender.val() == 0){
        gender.next().show().html("Gender is required");
        errors++;
    }
    else if(isNaN(gender.val())){
        gender.next().show().html("Invalid gender type");
        errors++;
    }
    else {
        gender.next().hide().html("");

    }
    if(!price.val()){
        price.next().show().html("Price is required");
        errors++
    }
    else if(isNaN(price.val())){
        $('#addPrice').next().show().html("Invalid price");
        errors++
    }
    else {
        price.next().hide().html("");
    }
    if(brend.val() == 0){
        brend.next().show().html("Brend is required");
        errors++
    }
    else if(isNaN(brend.val())){
        brend.next().show().html("Invalid brend type");
        errors++
    }
    else {
        brend.next().hide().html("");
    }
    if(category.val() == 0){
        category.next().show().html("Category is required");
        errors++
    }
    else if(isNaN(category.val())){
        category.next().show().html("Invalid category type");
        errors++
    }
    else {
        category.next().hide().html("");
    }
    if(color.val() == 0){
        color.next().show().html("Color is required");
        errors++
    }
    else if(isNaN(color.val())){
        color.next().show().html("Invalid color type");
        errors++
    }
    else {
        color.next().hide().html("");
    }
    if(imageFormat == undefined){
        $('#addImage').next().show().html("Image is required")

    }
    else if (!allowedFormats.includes(imageFormat.type)) {
        image.next().show().html("Please upload an image in JPG, JPEG, or PNG format")
    }
    else if (imageFormat.size > maxSize) {
        image.next().show().html("The image size exceeds the maximum limit of 2MB.")

    }
    else{
        image.next().hide().html("")
    }

    if(errors){
        return true
    }
    return false;
}
