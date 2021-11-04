<div class="d-flex justify-content-center align-items-center text-center">
    <div class="row gy-3 rounded bg-primary shadow my-5 col-10 col-sm-6 col-lg-6 p-3">
        <div class="col-lg-12">
            <h5 class="text-primary fw-bold">Create Your Account</h5>
            <form class="row mt-3 gy-3">
                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <h6 class="text-secondary fw-bold">Personal Information</h6>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" id="fullName" class="form-control form-control-sm mt-3 presco-input registration-input" placeholder="Full Name">
                    </div>
                    <div class="col-lg-12">
                        <input type="text" id="birthDate" class="form-control form-control-sm mt-3 presco-input registration-input" placeholder="Birth Date" readonly>
                    </div>
                    <div class="col-lg-12">
                        <select name="" id="gender" class="form-select form-select-sm mt-3 presco-input-select registration-input">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <h6 class="text-secondary fw-bold">Account Information</h6>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" id="username" class="form-control form-control-sm mt-3 presco-input registration-input" placeholder="Username">
                    </div>
                    <div class="col-lg-12">
                        <input type="text" id="email" class="form-control form-control-sm mt-3 presco-input registration-input" placeholder="Email Address">
                    </div>
                    <div class="col-lg-12">
                        <input type="password" id="password" class="form-control form-control-sm mt-3 presco-input registration-input" placeholder="Password" autocomplete="on">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="d-flex justify-content-center align-items-center">
                <a href="<?php echo base_url();?>login"><button class="btn btn-sm btn-primary mx-3" type="button">Login</button></a>
                <button id="btnRegister" class="btn btn-sm btn-primary mx-3" type="button">Register</button>
            </div>
        </div>
        <div class="col-lg-12">
            <small class="fst-italic"><a href="#" class="text-primary">Forgot Password?</a></small>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>public/js/user_auth/register.js"></script>