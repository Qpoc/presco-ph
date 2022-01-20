<?php require("profile_navigation.php") ?>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Profile</h3>
                    <hr>
                </div>
                <div class="col-lg-4 p-3">
                    <h5 class="text-primary">Personal Profile</h5>
                    <div class="profile-info">
                        <p id="name" class="text-secondary"></p>
                        <p id="email" class="text-secondary"></p>
                        <p id="birthdate" class="text-secondary"></p>
                        <p id="gender" class="text-secondary"></p>
                    </div>
                </div>
                <div class="col-lg-4 p-3">
                    <h5 class="text-primary">Address</h5>
                    <div class="profile-info">
                        <p id="address" class="text-secondary"></p>
                    </div>
                </div>
                <div class="col-lg-4 p-3">
                    <h5 class="text-primary">Mobile Number</h5>
                    <div class="profile-info">
                        <p id="mobileNo" class="text-secondary"></p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex">
                        <button class="btn btn-sm btn-primary">Edit Profile</button>
                        <button class="btn btn-sm btn-primary ms-3">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        prescoExecutePOST('api/BuyerController/getBuyerInfo', {
            "email" : Cookies.get("email")
        }, function (res) {
            if (res.status == "Success") {
                $("#name").html(res.response[0].first_name + " " + res.response[0].last_name);
                $("#email").html(res.response[0].email);
                $("#birthdate").html(res.response[0].birthdate);
                $("#address").html(res.response[0].address);
                $("#gender").html(res.response[0].gender);
                $("#mobileNo").html(res.response[0].contact_number);
            }
        })
    });
</script>