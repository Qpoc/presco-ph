<?php require("navigation.php") ?>
        <div class="col-lg-10 main-content">
            <div class="row gy-3 p-3">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Order</h3>
                    <hr>
                </div>
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Incomplete Transaction</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-no-sales-tab" data-bs-toggle="pill" data-bs-target="#pills-no-sales" type="button" role="tab" aria-controls="pills-no-sales" aria-selected="false">Complete Transaction</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                    <div class="tab-pane fade" id="pills-no-sales" role="tabpanel" aria-labelledby="pills-no-sales-tab">
                        <div class="col-lg-12 shadow p-3">
                            <table id="orderTableComplete" class="table table-responsive text-center">
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
        var incTransact = document.getElementById("pills-home-tab");
        var completeTransact = document.getElementById("pills-no-sales-tab");

        incTransact.addEventListener("shown.bs.tab", function(e){
            getTransactionStatus();
        });

        completeTransact.addEventListener("shown.bs.tab", function(e){
            getCompleteTransaction();
        });

        getTransactionStatus();
        function getTransactionStatus() { 
            let data = [];
            $("#orderTable").DataTable().clear().destroy();
            prescoExecuteGET("api/AdminController/getTransactionStatus", function(res) {
                if (res.status == "Success") {
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

                    $("#orderTable").DataTable().clear().destroy();
                    $("#orderTable").DataTable({
                        data : data,
                        pageLength: 5
                    });

                    $("#orderTable").undelegate(".btnDetails","click").on("click", ".btnDetails", function(e){
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

                    $("#orderTable").undelegate(".selectStatus","change").on("change", ".selectStatus", function(e){
                        const trackingID = $(e.target).attr("tracking-id");
                        const status = $(e.target).val();
                        
            
                        const payload = {
                            "tracking_id" : trackingID,
                            "status" : status
                        };

                        prescoExecutePOST("api/AdminController/updateCustomerStatus", payload, function(res){
                            getTransactionStatus();
                        });
                    });
                }else{
                    $("#orderTable").DataTable().clear().destroy();
                    $("#orderTable").DataTable();
                }
            });
        }
        function getCompleteTransaction(){
            let data = [];
            prescoExecuteGET("api/AdminController/getCompleteTransaction", function(res) {
                if (res.status == "Success") {
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
                            status,
                            `<button data-bs-toggle="modal" data-bs-target="#M_orders" customer-name="${name}" tracking-id="${trackingID}" class="btnDetails btn-primary btn btn-sm">View Details</button>`
                        ])
                    });

                    $("#orderTableComplete").DataTable().clear().destroy();
                    $("#orderTableComplete").DataTable({
                        data : data,
                        pageLength: 5
                    });

                    $("#orderTableComplete").undelegate(".btnDetails","click").on("click", ".btnDetails" ,function(e){
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
                            getTransactionStatus();
                        });
                    });
                }else{
                    $("#orderTable").DataTable().clear().destroy();
                    $("#orderTable").DataTable();
                }
            });
        }
    });
</script>