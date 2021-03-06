<div class="d-flex justify-content-center align-items-center text-center">
    <div class="row gy-3 rounded bg-primary shadow my-5 col-10 col-sm-6 col-lg-6 p-3">
        <form id="registerForm" action="#!">
            <div class="col-lg-12">
                <h5 class="text-primary fw-bold">Create Your Account</h5>
                <div class="row mt-3 gy-3">
                    <div class="col-lg-6">
                        <div class="col-lg-12">
                            <h6 class="text-secondary fw-bold">Personal Information</h6>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" id="firstName" class="auth-regis form-control form-control-sm mt-3 presco-input registration-input" placeholder="First Name" required>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" id="lastName" class="auth-regis form-control form-control-sm mt-3 presco-input registration-input" placeholder="Last Name" required>
                        </div>
                        <div class="userinfo">
                            <input id="addressField" class="auth-regis form-control form-control-sm mt-3 presco-input registration-input" placeholder="Address" type='text' name='address' value='' required />
                        </div>
                        <div class="col-lg-12">
                            <input type="text" id="birthDate" class="auth-regis form-control form-control-sm mt-3 presco-input registration-input" placeholder="Birth Date" readonly required>
                        </div>
                        <div class="col-lg-12">
                            <select name="" id="gender" class="auth-down form-select form-select-sm mt-3 presco-input-select registration-input" required>
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
                            <input type="text" id="username" class="auth-regis form-control form-control-sm mt-3 presco-input registration-input" placeholder="Username" required>
                        </div>
                        <div class="col-lg-12">
                            <input type="email" id="email" class="auth-regis form-control form-control-sm mt-3 presco-input registration-input" placeholder="Email Address" required>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" id="contactNumber" class="auth-regis form-control form-control-sm mt-3 presco-input registration-input" placeholder="Contact No." required>
                        </div>
                        <div class="col-lg-12">
                            <input type="password" id="password" class="auth-regis form-control form-control-sm mt-3 presco-input registration-input" placeholder="Password" autocomplete="on" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-3">
                <div class="d-flex justify-content-center align-items-center">
                    <a href="<?php echo base_url();?>login"><button class="btn btn-sm btn-primary mx-3" type="button">Login</button></a>
                    <button type="submit" class="btn btn-sm btn-primary mx-3" type="button">Register</button>
                </div>
            </div>
        </form>
        <div class="col-lg-12">
            <small class="fst-italic"><a href="#" class="text-primary">Forgot Password?</a></small>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>public/js/user_auth/register.js"></script>
