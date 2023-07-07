
$(document).ready(function(){
	"use strict";

	var window_width 	 = $(window).width(),
	window_height 		 = window.innerHeight,
	header_height 		 = $(".default-header").height(),
	header_height_static = $(".site-header.static").outerHeight(),
	fitscreen 			 = window_height - header_height;


	$(".fullscreen").css("height", window_height)
    $(".fitscreen").css("height", fitscreen);

  //------- Active Nice Select --------//

    $('select').niceSelect();
    $('.navbar-nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

    $('.img-pop-up').magnificPopup({
        type: 'image',
        gallery:{
        enabled:true
        }
    });

    // Search Toggle
    $("#search_input_box").hide();
    $("#search").on("click", function () {
        $("#search_input_box").slideToggle();
        $("#search_input").focus();
    });
    $("#close_search").on("click", function () {
        $('#search_input_box').slideUp(500);
    });

    /*==========================
		javaScript for sticky header
		============================*/
			$(".sticky-header").sticky();

    /*=================================
    Javascript for banner area carousel
    ==================================*/
    $(".active-banner-slider").owlCarousel({
        items:1,
        autoplay:false,
        autoplayTimeout: 5000,
        loop:true,
        nav:true,
        navText:["<img src='img/banner/prev.png'>","<img src='img/banner/next.png'>"],
        dots:false
    });

    localStorage.setItem("limit",0);

    let totalPages = $('#paginationTop').data('totalpages');
    localStorage.setItem("totalPages",totalPages);

    
    /*=================================
    Javascript for exclusive area carousel
    ==================================*/
    $(".active-exclusive-product-slider").owlCarousel({
        items:1,
        autoplay:false,
        autoplayTimeout: 5000,
        loop:true,
        nav:true,
        navText:["<img src='assets/img/product/prev.png'>","<img src='assets/img/product/next.png'>"],
        dots:false
    });

    //--------- Accordion Icon Change ---------//

    $('.collapse').on('shown.bs.collapse', function(){
        $(this).parent().find(".lnr-arrow-right").removeClass("lnr-arrow-right").addClass("lnr-arrow-left");
    }).on('hidden.bs.collapse', function(){
        $(this).parent().find(".lnr-arrow-left").removeClass("lnr-arrow-left").addClass("lnr-arrow-right");
    });

  // Select all links with hashes
  $('.main-menubar a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function(event) {
      // On-page links
      if (
        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
        && 
        location.hostname == this.hostname
      ) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
          // Only prevent default if animation is actually gonna happen
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top-70
          }, 1000, function() {
            // Callback after animation
            // Must change focus!
            var $target = $(target);
            $target.focus();
            if ($target.is(":focus")) { // Checking if the target was focused
              return false;
            } else {
              $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again
            };
          });
        }
      }
    });




    $(document).ready(function() {
        $('#mc_embed_signup').find('form').ajaxChimp();
    });   



     if(document.getElementById("js-countdown")){

        var countdown = new Date("October 17, 2018");

        function getRemainingTime(endtime) {
            var milliseconds = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor(milliseconds / 1000 % 60);
            var minutes = Math.floor(milliseconds / 1000 / 60 % 60);
            var hours = Math.floor(milliseconds / (1000 * 60 * 60) % 24);
            var days = Math.floor(milliseconds / (1000 * 60 * 60 * 24));

        return {
            'total': milliseconds,
            'seconds': seconds,
            'minutes': minutes,
            'hours': hours,
            'days': days
            };
        }

        function initClock(id, endtime) {
            var counter = document.getElementById(id);
            var daysItem = counter.querySelector('.js-countdown-days');
            var hoursItem = counter.querySelector('.js-countdown-hours');
            var minutesItem = counter.querySelector('.js-countdown-minutes');
            var secondsItem = counter.querySelector('.js-countdown-seconds');

        function updateClock() {
            var time = getRemainingTime(endtime);

            daysItem.innerHTML = time.days;
            hoursItem.innerHTML = ('0' + time.hours).slice(-2);
            minutesItem.innerHTML = ('0' + time.minutes).slice(-2);
            secondsItem.innerHTML = ('0' + time.seconds).slice(-2);

            if (time.total <= 0) {
              clearInterval(timeinterval);
            }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        initClock('js-countdown', countdown);

  };



      $('.quick-view-carousel-details').owlCarousel({
          loop: true,
          dots: true,
          items: 1,
      })



    //----- Active No ui slider --------//



    $(function(){

        if(document.getElementById("price-range")){
        
        var nonLinearSlider = document.getElementById('price-range');
        
        noUiSlider.create(nonLinearSlider, {
            connect: true,
            behaviour: 'tap',
            start: [ 0, 1000 ],
            range: {
                // Starting at 500, step the value by 500,
                // until 4000 is reached. From there, step by 1000.
                'min': [ 0 ],
                'max': [ 1000 ]
            }
        });


        var nodes = [
            document.getElementById('lower-value'), // 0
            document.getElementById('upper-value')  // 1
        ];

        // Display the slider value and how far the handle moved
        // from the left edge of the slider.
        nonLinearSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
            nodes[handle].innerHTML = values[handle];
        });

        }

    });

    
    //-------- Have Cupon Button Text Toggle Change -------//

    $('.have-btn').on('click', function(e){
        e.preventDefault();
        $('.have-btn span').text(function(i, text){
          return text === "Have a Coupon?" ? "Close Coupon" : "Have a Coupon?";
        })
        $('.cupon-code').fadeToggle("slow");
    });

    $('.load-more-btn').on('click', function(e){
        e.preventDefault();
        $('.load-product').fadeIn('slow');
        $(this).fadeOut();
    });
    




  //------- Start Quantity Increase & Decrease Value --------//


    var value,
        quantity = document.getElementsByClassName('quantity-container');

    function createBindings(quantityContainer) {
        var quantityAmount = quantityContainer.getElementsByClassName('quantity-amount')[0];
        var increase = quantityContainer.getElementsByClassName('increase')[0];
        var decrease = quantityContainer.getElementsByClassName('decrease')[0];
        increase.addEventListener('click', function () { increaseValue(quantityAmount); });
        decrease.addEventListener('click', function () { decreaseValue(quantityAmount); });
    }

    function init() {
        for (var i = 0; i < quantity.length; i++ ) {
            createBindings(quantity[i]);
        }
    };

    function increaseValue(quantityAmount) {
        value = parseInt(quantityAmount.value, 10);

        console.log(quantityAmount, quantityAmount.value);

        value = isNaN(value) ? 0 : value;
        value++;
        quantityAmount.value = value;
    }

    function decreaseValue(quantityAmount) {
        value = parseInt(quantityAmount.value, 10);

        value = isNaN(value) ? 0 : value;
        if (value > 0) value--;

        quantityAmount.value = value;
    }

  init();

//------- End Quantity Increase & Decrease Value --------//

  /*----------------------------------------------------*/
  /*  Google map js
    /*----------------------------------------------------*/
    /////////////////**/////////////////////////
    //MINE JAVASCRIPT


    //#region FILTER
    //-----------------------------------------------------------

    $(document).on('click','.gender',function (e){
        e.preventDefault();
        let findClass = $('#categories').find('.active-filter');
        if(typeof(findClass[0]) != 'undefined'){
            findClass[0].classList.remove('active-filter');
        }
        this.classList.add("active-filter");
        filter();
    })

    $(document).on("click",'.noUi-handle-lower',function (){
        filter();
    })
    $(document).on("click",'.noUi-handle-upper',function (){
        filter();
    })

    //#region Sort

    $('#ddlSort').change(function (){
        filter();
    })

    //#endregion


    $(document).on('click','.brands',function (e){
        filter();
    })
    $(document).on('click','.colors',function (e){
        filter();
    })
    //---------------------------------------------------------
    //#endregion

    //#region Register
//REGEX
    let reNameLastname = /^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})?$/;
    let reUsername = /^[a-zA-Z0-9_-]{3,16}$/;
    let rePhone = /^[\d]{7,10}$/;
    let reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    let rePassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;




    $(document).on("click","#btnRegister",function (e){
        let name = $('#regName');
        let lastName = $('#regLastname');
        let username = $('#regUsername');
        let phone = $('#regPhone');
        let email = $('#regEmail');
        let password = $('#regPassword');
        let nameErr,LnameErr,userNErr,phoneErr,emailErr,passErr;


            nameErr = checkInputField(name,name.val(),reNameLastname);
            LnameErr = checkInputField(lastName,lastName.val(),reNameLastname);
            userNErr = checkInputField(username,username.val(),reUsername);
            phoneErr = checkInputField(phone,phone.val(),rePhone);
            emailErr = checkInputField(email,email.val(),reEmail);
            passErr = checkInputField(password,password.val(),rePassword);

            if(!emailErr){
                $('#emailExists').hide();
            }
            if(!userNErr){
                $('#usernameExists').hide();
            }
            if(!phoneErr){
                $('#phoneExists').hide();
            }

    if(nameErr && LnameErr && userNErr && phoneErr && emailErr && passErr){
        let objectToSend = {
            name : name.val(),
            lastName : lastName.val(),
            username : username.val(),
            phone : phone.val(),
            email : email.val(),
            password : password.val()
        }

        ajaxCallback("models/registration.php","POST",objectToSend,function (res){
            alert("SUCCESS");
            console.log(res);
            if(res.usernameError){
                $('#regUsername').next().hide();
                $('#usernameExists').show();
                $('#usernameExists').html(res.usernameError);

            }
            else {
                $('#usernameExists').hide();
            }
            if(res.phoneError){
                $('#regPhone').next().hide();
                $('#phoneExists').show();
                $('#phoneExists').html(res.phoneError);
            }
            else {
                $('#phoneExists').hide();
            }
            if(res.emailError) {
                $('#regEmail').next().hide();
                $('#emailExists').show();
                $('#emailExists').html(res.emailError);
            }
            else {
                $('#emailExists').hide();
            }


        },function (xhr){
            if(xhr.status == 200){
                window.location.replace("index.php?page=login&register=success");
            }
        })

    }
})



//#endregion

    //#region Password  - show/hide
    $('#togglePassword').click(function(){
        let type = $('#regPassword').attr('type');
        if(type === "password"){
            $('#regPassword').attr('type','text');
        }
        else {
            $('#regPassword').attr('type','password');
        }
    })

//#endregion

    //#region Login
    $('#btnLogin').click(function (){
        let username = $('#loginUsername').val();
        let password = $('#loginPassword').val();

        let usernameIsCorrect = true;
        let passwordIsCorrect = true;

        if(!username){
            $('#loginUsername').next().show();
            $('#loginUsername').next().html("Username is required");
            usernameIsCorrect = false;
        }
        else {
            $('#loginUsername').next().hide();
            $('#loginUsername').next().html("");
            usernameIsCorrect = true;
        }

        if(!password){
            $('#loginPassword').next().show();
            $('#loginPassword').next().html("Password is required");
            passwordIsCorrect = false;
        }
        else {
            $('#loginPassword').next().hide();
            $('#loginPassword').next().html("");
            passwordIsCorrect = true;
        }

        if(usernameIsCorrect && passwordIsCorrect){
            let credentials = {
                username : username,
                password: password
            }
            ajaxCallback("models/login.php","POST",credentials,function (res){
                console.log(res);
                if(res.usernameError){
                    $('#loginUsername').next().show();
                    $('#loginUsername').next().html(res.usernameError);
                }
                else {
                    $('#loginUsername').next().hide();
                    $('#loginUsername').next().html("");
                }

                if(res.passwordError){
                    $('#loginPassword').next().show();
                    $('#loginPassword').next().html(res.passwordError);
                }
                else {
                    $('#loginPassword').next().hide();
                    $('#loginPassword').next().html("");
                }
                if(res.blockedUser){
                    $('#loginPassword').next().show();
                    $('#loginPassword').next().html(res.blockedUser);
                }

                if(res == "success"){
                    window.location.replace("index.php?page=shop")
                }
            },function (xhr){
                console.log(xhr)
            })
        }

    })
    //#endregion

    //#region Review
    let stars = 0;
    let reMessage = /^[a-zA-Z0-9'.,!\s]{1,}$/
    $('#submitReview').click(function (){
        let userRegistered = $('#userRegistered').val();
        if(!userRegistered){
            let modalText = "You must be <a href='index.php?page=login' class='text-secondary'>registered</a> "
            printModal("Review Error",modalText,"showModal")
        }
        else {
            let fullName = $('#reviewFullName').val();
            let email = $('#reviewEmail').val();
            let review = $('#reviewMessage').val();
            let user = parseInt($('#userID').val());
            let product = parseInt($('#productID').val());
            stars = parseInt(stars);
            let errors = 0;

            if(!reMessage.test(review)){
                $('#reviewMessage').next().show();
                errors++;
            }
            else {
                $('#reviewMessage').next().hide();
            }
            if((stars <= 0 || stars > 5) && !errors){
                $('#reviewError').show();
                $('#reviewError').html("You must add the number of stars");
                errors++;
            }
            else {
                $('#reviewError').hide();
                $('#reviewError').html("");
            }

            if(isNaN(stars)){
                //404
                window.location.replace("index.php");
            }

            if(!errors){
                let objToSend = {
                    fullName : fullName,
                    email : email,
                    message : review,
                    starsNumber : stars,
                    userID : user,
                    productID : product
                }
                ajaxCallback("models/addReview.php","POST",objToSend,function (res){
                    console.log(res);
                    if(res.error){
                        $('#reviewError').show();
                        $('#reviewError').html(res.error);
                    }
                    else {
                        $('#reviewError').hide();
                        $('#reviewError').html("");
                    }
                    if(res == "success"){
                        $('#success').show();
                        $('#success').html("You have successfully added a comment");
                    }
                },function (xhr){
                    alert("REVIEW ERROR")
                })
            }

        }
    })


    $('.reviewStars').click(function (e){
        e.preventDefault();
        stars = this.id;
        let allStars = $('.reviewStars');
            for(let s of allStars){
                if(s.id <= stars){
                    s.style.color = "#fbd600"
                }
                else {
                    s.style.color = "grey"
                }

            }


    })

    //#endregion

    //#region Comments
    let commentID = null;
    $('#btnComment').click(function (){
        let userRegistered = $('#userRegistered').val();
        if(!userRegistered){
            let modalText = "You must be <a href='index.php?page=login' class='text-secondary'>registered</a> "
            printModal("Comment Error",modalText,"showModal")
        }
        else {
            let fullName = $('#commentFullName').val();
            let email = $('#commentEmail').val();
            let comment = $('#comment').val();
            let user = parseInt($('#userID').val());
            let product = parseInt($('#productID').val());
            let errors = 0;
            if(!reMessage.test(comment)){
                $('#comment').next().show();
                errors++;
            }
            else {
                $('#comment').next().hide();
            }
            if(!errors){
                let object = {
                    fullName : fullName,
                    email : email,
                    comment: comment,
                    userID : user,
                    productID : product,
                    replayID : commentID
                }
                ajaxCallback("models/comment.php","POST",object,function (res){
                    console.log(res);
                    if(res.error){
                        $('#commentError').show();
                        $('#commentError').html(res.error);
                    }
                    else {
                        $('#commentError').hide();
                        $('#commentError').html("");
                    }
                    if(res == "success"){
                        $('#successComment').show();
                        $('#successComment').html("You have successfully added a comment");
                    }
                },function (xhr){
                    alert("COMMENT ERROR");
                    console.log(xhr);
                })
            }
        }
    })

    $('.reply_btn').click(function (){
        let commentID = $(this).data('id');
        let fullName = $(this).data('fullname');
        let findReplayBox = $('#commentList').find('.ia-reply-item')[0];
        if(findReplayBox != undefined){
            findReplayBox.remove()
        }
        console.log(fullName);
        $(this).parent().parent().parent().append(showReplayBox(fullName))
       // $(this).parent().parent().parent().append("<strong>Hello</strong>")

        $('#ia-replay').click(function(){
            let replayMessage = $('#replayMessage');
            if(!reMessage.test(replayMessage.val())){
                replayMessage.next().show();
            }
            else {
                replayMessage.next().hide();
                let userID = parseInt($('#userID').val());
                let productID = parseInt($('#productID').val());
                let replayObject = {
                    userID : userID,
                    productID : productID,
                    fullName : fullName,
                    commentID : commentID,
                    message: replayMessage.val()
                }
                ajaxCallback("models/answers.php","POST",replayObject,function (){
                    //$('#replaySuccess').show();
                    let dateOptions = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        hour12: true
                    };

                    let now = new Date();
                    let formattedDateTime = now.toLocaleString('en-US', dateOptions);
                    $('.ia-reply-item').hide();

                    printAnswers(commentID,fullName,formattedDateTime,replayMessage.val());
                },function (xhr){
                    console.log(xhr)
                })
            }
        })

    })


    //#endregion

    //#region Pagination

    $(document).on("click",".ia-pagination",function (e){
        e.preventDefault();
        let limit = $(this).data("limit");
        localStorage.setItem("limit",limit);
        ajaxCallback("models/pagination.php","POST",{limit : limit},function (res){
            localStorage.setItem("currentPage",limit);
            printProduct(res);
            printPagination(limit);
        },function (xhr){
            console.log(xhr);
            alert("PAGINATION ERROR");
        })
    })

    $(document).on("click",".prev-arrow",function (e){
        e.preventDefault();
        let limit = parseInt(localStorage.getItem("limit"));
        let totalPages = localStorage.getItem("totalPages");
        if(limit > 0){
            limit--;
            console.log(limit);
            localStorage.setItem("limit",limit);
            ajaxCallback("models/pagination.php","POST",{limit : limit},function (res){
                localStorage.setItem("currentPage",limit);
                printProduct(res);
                printPagination(limit);
            },function (xhr){
                console.log(xhr);
                alert("PAGINATION ERROR");
            })
        }
    })

    $(document).on("click",".next-arrow",function (e){
        e.preventDefault();
        let limit = parseInt(localStorage.getItem("limit"));
        let totalPages = localStorage.getItem("totalPages");
        console.log(limit)
        console.log(totalPages)
        if(limit+1 < totalPages){

            limit++;
            localStorage.setItem("limit",limit);
            ajaxCallback("models/pagination.php","POST",{limit : limit},function (res){
                localStorage.setItem("currentPage",limit);
                printProduct(res);
                printPagination(limit);
            },function (xhr){
                console.log(xhr);
                alert("PAGINATION ERROR");
            })
        }


    })
    //#endregion

    //#region Add To Cart
    $(document).on('click','.ia-addBag',function (e){
        e.preventDefault();
        let user = $(this).data('user');
        let productID = $(this).data('productid');
        let quantity = 1;
        if(!user){
            //$('#modalCart').show();
            printModal("Message","You must be registered","showModal")
        }
        else {
            addToCart(productID,quantity);
        }
    })
    $('.addToCart').click(function (e){
        e.preventDefault();
        let user = $('#userRegistered').val();
        let quantity = $('.qty').val();
        let productID = $('#productID').val();
        console.log(quantity)
        if(!user){
            printModal("Message","You must be registered","showModal")
        }
        else {
            addToCart(productID,quantity);
        }
    })
    function addToCart(productID,quantity){
        let userID = $('#userID').val();
        let obj = {
            userID : userID,
            productID : productID,
            quantity : quantity
        }
        ajaxCallback("models/addToCart.php","POST",obj,function (res){
            console.log(res);
            $('#modalCart').show();
            $('#cartMsg').html(res);
            setTimeout(function (){
                $('#modalCart').hide();
                $('#cartMsg').html("");
            },1500);
        },function (xhr){
            console.log(xhr)
        })

    }

    $('.ia-increase').click(function (){
        let qty = $('#sst').val();

        if(qty >= 1 && qty < 5){
            $('#sst').val(function (i,oldVal){
                return ++oldVal;
            })
        }
    })

    $('.ia-reduced').click(function (){
        let qty = $('#sst').val();
        if(qty > 1){
            $('#sst').val(function (i,oldVal){
                return --oldVal;
            });
        }
    })

    $('.ia-trash').click(function (){
        let cartProductID = $(this).data('id');
        ajaxCallback("models/updateCart.php","POST",{id: cartProductID,action: "DELETE"},function (res){
            location.reload();

        },function (xhr){
            console.log(xhr)
        })
    })
    //#endregion

    //#region Order
    let reAddress = /^([A-Z][a-z]{2,15}|[0-9]|[0-9][0-9])(\s([A-Z][a-z]{1,15}|[0-9]|[0-9][0-9]))*$/;;
    let reCity = /^[a-zA-z]{3,25}$/;
    let rePostcode = /[\d]{5}/;
    $('#checkoutOrder').click(function () {
        let firstName = $('#firstNameOrder').val();
        let lastName = $('#lastNameOrder').val();
        let companyName = $('#company').val();
        let phone = $('#phoneNumberOrder').val();
        let email = $('#emailOrder').val();
        let firstAddress = $('#add1').val();
        let city = $('#cityOrder').val();
        let postcode = $('#zip').val();
        let detailsMsg = $('#orderMessage').val();
        let cartID = $('#cartID').val();

        let errors = 0;
        //#region validation - IF/ELSE
        if(!reNameLastname.test(firstName)){
            $('#firstNameOrder').next().show();
            errors++;
        }
        else {
            $('#firstNameOrder').next().hide();
        }
        if(!reNameLastname.test(lastName)){
            $('#lastNameOrder').next().show();
            errors++;
        }
        else {
            $('#lastNameOrder').next().hide();
        }
        if(companyName != "" && !reMessage.test(companyName)){
            $('#company').next().show();
            errors++;
        }
        else {
            $('#company').next().hide();
        }
        if(!rePhone.test(phone)){
            $('#phoneNumberOrder').next().show();
            errors++;
        }
        else{
            $('#phoneNumberOrder').next().hide();
        }
        if(!reEmail.test(email)){
            $('#emailOrder').next().show();
            errors++;
        }
        else {
            $('#emailOrder').next().hide();
        }
        if(!reAddress.test(firstAddress)){
            $('#add1').next().show();
            errors++;
        }
        else {
            $('#add1').next().hide();
        }
        if(!reCity.test(city)){
            $('#cityOrder').next().show();
            errors++;
        }
        else {
            $('#cityOrder').next().hide();
        }
        if(!rePostcode.test(postcode)){
            $('#zip').next().show();
            errors++;
        }
        else {
            $('#zip').next().hide();
        }

        //#endregion

        if(!errors){
            //UPIS U ORDER I REDIREKCIJA NA CONFIRMATION
            let orderObject = {
                firstName: firstName,
                lastName: lastName,
                companyName: companyName,
                phone:  phone,
                email: email,
                firstAddress: firstAddress,
                city: city,
                postcode: postcode,
                detailsMsg: detailsMsg,
                cartID : cartID
            }
            ajaxCallback("models/order.php","POST",orderObject,function (res){
                $('#serverError').hide();
                $('.successOrder').show();
                $('#checkoutOrder').attr("disabled","disabled")
            },function (xhr){

                if(xhr.status === 400){
                    let errors = JSON.parse(xhr.responseText);
                    let string = "<ol>";
                    for(let e of errors){
                        string += `<li>${e}</li>`;
                    }
                    string += `</ol>`;
                    $('#serverError').html(string).show();
                }
            })

        }


    })
    //#endregion

    //#region Contact- Mailer
        $('#btnSendMessage').click(function (){
            let name = $('#nameMessage').val();
            let email = $('#emailMessage').val();
            let subject = $('#subjectMessage').val();
            let message = $('#message').val();
            let errors = 0;

            if(!name){
                $('#nameMessage').next().show();
                errors++
            }
            else {
                $('#nameMessage').next().hide();
            }
            if(!email){
                $('#emailMessage').next().html('Email is required')
                $('#emailMessage').next().show()
                errors++
            }
            else if(!reEmail.test(email)){
                $('#emailMessage').next().html('Incorrect email')
                $('#emailMessage').next().show()
                errors++
            }
            else {
                $('#emailMessage').next().html('')
                $('#emailMessage').next().hide()
            }
            if(!subject){
                $('#subjectMessage').next().show();
                errors++;
            }
            else {
                $('#subjectMessage').next().hide();
            }
            if(!message){
                $('#message').next().show();
                errors++
            }
            else {
                $('#message').next().hide();
            }

            if(!errors){
                let obj = {
                    name : name,
                    email: email,
                    subject: subject,
                    message: message
                }
                ajaxCallback("models/sendEmail.php","POST",obj,function (res){
                    $('#contactMsg').show();
                })
            }
        })
    //#endregion
 });



//Function for check what is checked(color,brend) and return ID
function checkedFilters(value){
    let inputs = document.querySelectorAll(value);
    let checked = null;
    for(let i of inputs){
        if(i.checked){
            checked = i.value;
        }
    }
    return checked
}

//Function for check category/gender, search by class(active-filter)
function findCheckedCategories(){
    let tmp = $('#categories').find('.active-filter');
    let categoryID = genderID = null;
    if(typeof(tmp[0]) != 'undefined'){
        categoryID = tmp.data('categoryid');
        genderID = tmp.data('genderid');
    }
    return {
        categoryID,
        genderID
    }
}

function filterPrice(){
    let lowerVal = $('#lower-value').html();
    lowerVal = parseFloat(lowerVal);
    let upperVal = $('#upper-value').html();
    upperVal = parseFloat(upperVal);

    return {
        minPrice : lowerVal,
        maxPrice : upperVal
    }

}
function filter(){
    let brendID = checkedFilters(".brands");
    let colorID = checkedFilters(".colors");
    let price = filterPrice();
    let minPrice = price.minPrice;
    let maxPrice = price.maxPrice;
    let categories = findCheckedCategories();
    let sort = $('#ddlSort').val();
    let categoryID = categories.categoryID;
    let genderID = categories.genderID;
    let limit = localStorage.getItem("limit");
    let obj = {
        genderID:  genderID,
        categoryID: categoryID,
        brendID : brendID,
        colorID : colorID,
        sort : sort,
        maxPrice : maxPrice,
        minPrice : minPrice,
        limit : limit
    }
    ajaxCallback("models/filter.php","POST",obj,function (res){
        console.log(res)
        printProduct(res);
    },function (xhr) {

    })
}
function checkInputField(field,value,regex){
    if(!regex.test(value)){
        field.next().show();
        return false;
    }
    else {
        field.next().hide();
        return true;
    }
}


/*************************************/
function printProduct(products){
    let userRegistered = $('#userRegistered').val();
    console.log(products);
    let string = "";
    if(!products.length){
        string = '<p class="alert alert-danger w-100 mt-3 h3 text-center">There are currently no products</p>';
    }
    for(let p of products){
        string += `<div class="col-lg-4 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="assets/img/product/${p.main_img}" alt="${p.name}"/>
                        <div class="product-details">
                            <h6>${p.name}</h6>
                                <div class="price">             
                                    <h6>$ ${p.newPrice}</h6>
                                <h6 class="l-through"> ${p.oldPrice == null ? "" : "$ " +p.oldPrice}</h6>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                    <span class="ti-bag ia-addBag" data-user="${userRegistered}"
                                                  data-productid="${p.product_id}"></span>
                                    <p class="hover-text">add to bag</p>
                                    </a>
                                    <a  href="index.php?page=singleProduct&id=${p.product_id}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>`;
    }
    $('#showPrdoucts').html(string);
}
function showReplayBox(name){
    let string = ` <div class="review_item reply ia-reply-item mt-5" >
                        <div class="media">
                            <div class="media-body">
                                <h4>${name}</h4>
                            </div>
                        </div>
                        <textarea rows="2" class="form-control" id="replayMessage"></textarea>
                        <p class="alert alert-danger error">Incorrect message!</p>
                        <button class="ia-btn" id="ia-replay">Replay</button>
                  </div>`;

    return string




}
function printModal(title,text,modalDiv){
    let string = `<div id="modal" style="display: block" class="modal" tabindex="-1">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-dark">${title}</h5>
                        <button type="button" class="btn-close btnCloseDelete" data-bs-dismiss="modal" aria-label="Close">X</button>
                      </div>
                      <div class="modal-body">
                        <p class="text-dark h3 alert alert-danger">${text}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnCloseDelete" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>`;
    $('#' + modalDiv).html(string);

    $('.btnCloseDelete').click(() => {
        $('#modal').css('display','none');
    })
}
function printAnswers(commentID,fullname,date,message){
    let parentDiv = document.createElement("div");
    let childDiv = document.createElement("div");
    let bodyDiv = document.createElement("div");
    let bodyH4 = document.createElement("h4");
    let bodyH5 = document.createElement("h5");
    let h4Text = document.createTextNode(fullname);
    let h5Text = document.createTextNode(date);
    let messageElement = document.createElement("p");
    let messageTxt = document.createTextNode(message);
    messageElement.appendChild(messageTxt);
    bodyH4.appendChild(h4Text);
    bodyH5.appendChild(h5Text);
    bodyDiv.appendChild(bodyH4);
    bodyDiv.appendChild(bodyH5);
    parentDiv.classList.add('review_item','reply',"mt-5");
    childDiv.classList.add('media');
    bodyDiv.classList.add('media-body');
    childDiv.appendChild(bodyDiv);
    parentDiv.appendChild(childDiv);
    parentDiv.appendChild(messageElement);

    document.getElementById(commentID+ "-comm").appendChild(parentDiv);
}

function printPagination(limit){
    let totalPages = $('.pagination').data('totalpages');
    let string = `<a href="#" class="prev-arrow">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                  </a>`;
                for(let i=0;i<totalPages;i++){
                    string += `<a href="#"
                      class="ia-pagination ${i == limit ? "active" : ""}"
                         data-limit="${i}">${i+1}</a>`
                }
            string +=`<a href="#" class="next-arrow">
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </a>
                    </div>`;

    $('#paginationTop').html(string);
    $('#paginationBottom').html(string);

}
function ajaxCallback(file,method,data,result,error) {
    $.ajax({
        url : file,
        method : method,
        data : data,
        success : result,
        error: error
    })
}
