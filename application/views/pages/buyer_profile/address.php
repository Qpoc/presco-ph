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
                                <button class="btn btn-sm btn-primary">Edit</button>
                            </td>
                        </tr>
                    `);
                });
            }
        })
    });
</script>