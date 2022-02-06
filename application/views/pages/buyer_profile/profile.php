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
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >Edit Profile</button>
                        <button class="btn btn-sm btn-primary ms-3">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
            <div class="col-sm-12 col-lg-6">
                <input type="text" class="form-control-sm form-control" placeholder= "First Name">
            </div>
            <div class="col-sm-12 col-lg-6">
                <input type="text" class="form-control-sm form-control" placeholder= "Last Name">
            </div>
            <div class="col-sm-12 col-lg-6">
                <input type="text" class="form-control-sm form-control" placeholder= "Email Address">
            </div>
            <div class="col-sm-12 col-lg-6">
                <input type="text" class="form-control-sm form-control" placeholder= "Mobile Number">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm">Save</button>
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