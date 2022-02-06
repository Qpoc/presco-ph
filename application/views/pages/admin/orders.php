<?php require("navigation.php") ?>
        <div class="col-lg-10 main-content">
            <div class="row gy-3 p-3">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Order</h3>
                    <hr>
                </div>
                <div class="col-lg-12 shadow p-3">
                    <table id="orderTable" class="table table-responsive text-center">
                        <thead class="text-secondary">
                            <tr>
                                <th>Tracking ID</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Email Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="M_orders" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-secondary">
                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <p class="text-primary" id="detailsTransactionID">Transaction:</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-primary" id="detailsDate">Date:</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-primary" id="detailsName">Customer Name:</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-primary" id="detailsMOP">Mode of Payment:</p>
                        </div>
                        <hr>
                        <div id="detailsProductList" class="col-lg-12" style="max-height: 300px; overflow:auto">
                            
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-end">
                                <div class="d-flex flex-column">
                                    <p id="subTotal">Subtotal:</p>
                                    <p id="delFee">Delivery Fee:</p>
                                    <p id="total">Total:</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let data = [];
        prescoExecuteGET("api/AdminController/getTransactionStatus", function(res) {
            let trackingID = "";
            let name = "";
            let address = "";
            let email = "";
            let status = "";
            res.response.forEach(transaction => {
                trackingID = transaction.tracking_id;
                name = transaction.first_name + " " + transaction.last_name;
                address = transaction.address;
                email = transaction.email;
                status = transaction.status == "1" ? "Pending" : transaction.status == "2" ? "Awaiting Shipment" : transaction.status == "3" ? "Awaiting Pickup" : transaction.status == "4" ? "Shipped" : transaction.status == "5" ? "Completed" : "Cancelled";

                data.push([
                    trackingID,
                    name,
                    address,
                    email,
                    `<select tracking-id="${trackingID}" class="selectStatus form-select form-select-sm">
                        <option disabled value="0">Select Status</option>
                        <option ${transaction.status == "1" ? "selected" : ""} value="1">Pending</option>
                        <option ${transaction.status == "2" ? "selected" : ""} value="2">Awaiting Shipment</option>
                        <option ${transaction.status == "3" ? "selected" : ""} value="3">Awaiting Pickup</option>
                        <option ${transaction.status == "4" ? "selected" : ""} value="4">Shipped</option>
                        <option ${transaction.status == "5" ? "selected" : ""} value="5">Completed</option>
                        <option ${transaction.status == "6" ? "selected" : ""} value="6">Cancelled</option>
                    </select>
                    `,
                    `<button data-bs-toggle="modal" data-bs-target="#M_orders" customer-name="${name}" tracking-id="${trackingID}" class="btnDetails btn-primary btn btn-sm">View Details</button>`
                ])
            });
            $("#orderTable").DataTable({
                data : data,
                pageLength: 10
            });

            $(".btnDetails").unbind("click").on("click", function(e){
                const trackingID = $(e.target).attr("tracking-id");
                const name = $(e.target).attr("customer-name");

                const payload = {
                    "tracking_id" : trackingID
                };

                prescoExecutePOST("api/AdminController/getTrackingInformation", payload, function(res){
                    $("#detailsTransactionID").html(`Transaction: ${res.response[0].transaction_id}`);
                    $("#detailsDate").html(`Date: ${res.response[0].created_date}`);
                    $("#detailsName").html(`Name: ${name}`);
                    $("#detailsMOP").html(`Mode of Payment: ${res.response[0].mode_payment == "1" ? "Cash on Delivery" : "Debit/Credit Card"}`);
                    $("#detailsProductList").html(``);
                    res.response.forEach(product => {
                        $("#detailsProductList").append(`
                            <div class="row">
                                <div class="col-lg-3 d-flex flex-column justify-content-center align-items-center">
                                    <div class="detailImage" style="max-width: 64px; max-height: 64px;">
                                        <img src="<?php echo base_url();?>${product.image}" alt="" style="max-width: 100%; max-height: 100%;">
                                    </div>
                                    <p class="text-primary">${product.product_name}</p>
                                </div>
                                <div class="col-lg-3 d-flex flex-column justify-content-center align-items-center">
                                    <p>&#8369; ${product.price}</p>
                                </div>
                                <div class="col-lg-3 d-flex flex-column justify-content-center align-items-center">
                                    <p>x${product.quantity}</p>
                                </div>
                                <div class="col-lg-3 d-flex flex-column justify-content-center align-items-center">
                                    <p>&#8369; ${parseFloat(product.price) * parseFloat(product.quantity)}</p>
                                </div>
                            </div>
                        `);
                    });

                    $("#subTotal").html(`Subtotal: &#8369; ${parseFloat(res.response[0].total_price - parseFloat(res.response[0].delivery_fee))}`);
                    $("#delFee").html(`Delivery Fee: &#8369; ${res.response[0].delivery_fee}`);
                    $("#total").html(`Total: &#8369; ${res.response[0].total_price}`);
                });
            });

            $(".selectStatus").unbind("change").on("change", function(e){
                const trackingID = $(e.target).attr("tracking-id");
                const status = $(e.target).val();
                
    
                const payload = {
                    "tracking_id" : trackingID,
                    "status" : status
                };

                prescoExecutePOST("api/AdminController/updateCustomerStatus", payload, function(res){
                    console.log(res);
                });
            });
        });
    });
</script>