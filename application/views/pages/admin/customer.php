<?php require("navigation.php") ?>
        <div class="col-lg-10 main-content">
            <div class="row gy-3 p-3">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Customer</h3>
                    <hr>
                </div>
                <div class="col-lg-12 shadow p-3">
                    <table id="customerTable" class="table table-responsive text-center">
                        <thead class="text-secondary">
                            <tr>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Email Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="M_addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-secondary">
                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <p>Product Name:</p>
                            <input id="productName" type="text" class="form-control form-control-sm" placeholder="Product Name">
                        </div>
                        <div class="col-lg-6">
                            <p>Product Image:</p>
                            <input id="productImage" type="file" class="form-control form-control-sm" placeholder="Product Image">
                        </div>
                        <div class="col-lg-12">
                            <p>Product Description:</p>
                            <textarea id="productDescription" textarea class="form-control form-control-sm" name="description" required></textarea>
                            <script>
                                    CKEDITOR.replace('description');
                            </script>
                        </div>
                        <div class="col-lg-6">
                            <p>Product Price:</p>
                            <input id="productPrice" type="text" class="form-control form-control-sm" placeholder="Product Price">
                        </div>
                        <div class="col-lg-6">
                            <p>Product Stocks:</p>
                            <input id="productStock" type="text" class="form-control form-control-sm" placeholder="Product Stocks">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" id="btnAddProduct">Save changes</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="M_banUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-secondary">
                    <div class="row gy-3">
                        <p>Are you sure you want to proceed?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="btnCloseAgreeBan">No</button>
                    <button type="button" class="btn btn-primary btn-sm" id="btnAgreeBan">Yes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        getBuyerList();
        function getBuyerList() { 
            prescoExecuteGET('api/BuyerController/getBuyerList', function(res){
                let data = [];
                res.response.forEach(customer => {
                    console.log(customer);
                    data.push([
                        customer.first_name + " " + customer.last_name,
                        customer.address,
                        customer.email,
                        `<button email="${customer.email}" ban="${customer.ban}" data-bs-toggle="modal" data-bs-target="#M_banUser" class="btn btn-sm ${customer.ban == 0 ? "btn-danger" : "btn-success"} btn-ban">${customer.ban == 0 ? "Ban" : "Unban"}</button>`
                    ]);
                    console.log(customer);
                })
                
                $("#customerTable").DataTable().clear().destroy();

                $("#customerTable").DataTable({
                    data : data,
                    pageLength: 5
                });

                $("#customerTable").undelegate(".btn-ban","click").on("click", ".btn-ban" ,function(e){
                    let isBan = $(e.target).attr("ban") == 0 ? 1 : 0;

                    $("#btnAgreeBan").attr("ban", isBan);
                    $("#btnAgreeBan").attr("email", $(e.target).attr("email"));

                    $("#btnAgreeBan").unbind("click").on("click", function(e){
                        let payload = {
                            "email" : $(e.target).attr("email"),
                            "ban" : $(e.target).attr("ban")
                        };
                        prescoExecutePOST('api/AdminController/banBuyer', payload, function(res){
                            if (res.status == "Success") {
                                $("#toastAddToCart").html(toast("Success", "Successfully ban/unban user, please refresh the page."))
                                $('.toast').toast('show');
                            }else{
                                $("#toastAddToCart").html(toast("Failed", "An error occurred."))
                                $('.toast').toast('show');
                            }

                            $("#btnCloseAgreeBan").click();
                            getBuyerList();
                        });
                    });

                });
            })
        }
    })
</script>