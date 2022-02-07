<?php require("profile_navigation.php") ?>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Address</h3>
                    <hr>
                </div>
                <div class="col-lg-12 p-3 table-responsive">
                    <table class="table text-center">
                        <thead class="text-secondary">
                            <tr>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="addressTable">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="editAddressForm" action="!#">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input id="addressEdit" type="text" required class="form-control form-control-sm" placeholder="Address"/>
        </div>
        <div class="modal-footer">
            <button id="editAddressClose" type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
        </div>
        </div>
    </div>
  </form>
</div>
<script>
    $(document).ready(function () {
        prescoExecutePOST('api/BuyerController/getBuyerInfo', {
            "email" : Cookies.get("email")
        }, function (res) {
            if (res.status == "Success") {
                res.response.forEach(address => {
                    $("#addressTable").append(`
                        <tr>
                            <td class="address">${address.address}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#editAddress" class="btn btn-sm btn-primary">Edit</button>
                            </td>
                        </tr>
                    `);
                });

                $("#addressEdit").val(res.response[0].address);
                $("#editAddressForm").submit(function(e){
                    e.preventDefault();
    
                    const payload = {
                        "address" : $("#addressEdit").val(),
                        "email" : Cookies.get("email")
                    }

                    prescoExecutePOST('api/BuyerController/updateAddress', payload, function(res){
                        if(res.status == "Success"){
                            $("#toastAddToCart").html(toast("Success", "You successfully updated your address, please refresh the page."));
                            $(".toast").toast("show");
                            $("#editAddressClose").click();
                        }else{
                            $("#toastAddToCart").html(toast("Failed", "An error occurred while updating your address."));
                            $(".toast").toast("show");
                        }
                    });
                });
            }
        })
    });
</script>