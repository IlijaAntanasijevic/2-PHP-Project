
<section id="registration" >
    <h1 class="text-center text-uppercase" id="registrationTitle">Create an Account</h1>
    <form class="container contact_form">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="regName" id="regName"/>
                <p class="alert alert-danger error">Incorrect name</p>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="regLastname">Lastname</label>
                <input type="text" class="form-control" id="regLastname" name="regLastname"  />
                <p class="alert alert-danger error">Incorrect last name</p>

            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-6 col-sm-12">
                <label for="regUsername">Username</label>
                <input type="text" class="form-control" id="regUsername" name="regUsername" />
                <p class="alert alert-danger error">Incorrect username: test25 / test_25<</p>
                <p class="alert alert-danger error" id="usernameExists"></p>

            </div>
            <div class="col-md-6 col-sm-12">
                <label for="regPhone">Phone</label>
                <input type="number" class="form-control" id="regPhone" name="regPhone"/>
                <p class="alert alert-danger error">Incorrect phone, 8-10 numbers</p>
                <p class="alert alert-danger error" id="phoneExists"></p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label for="regEmail">Email</label>
                <input type="text" class="form-control" id="regEmail" name="regEmail"/>
                <p class="alert alert-danger error">Email is not valid</p>
                <p class="alert alert-danger error" id="emailExists"></p>

            </div>
            <div class="col-md-6 col-sm-12">
                <label for="regPassword">Password</label>
                <input type="password" class="form-control" id="regPassword"  name="regPassword"/>
                <p class="alert alert-danger error">Incorrect password</p>
                <p class="form-text" id="passwordHint">Minimum 8 characters, at least one letter and one number</p>

                <i class="fa fa-eye" id="togglePassword"></i>
            </div>
        </div>
        <div id="btnRegistration">
                <a href="index.php?page=login" class="genric-btn danger ">Login</a>
                <p class="genric-btn primary ml-5" id="btnRegister">Submit</p>

        </div>
    </form>
</section>