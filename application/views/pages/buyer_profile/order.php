<?php require("profile_navigation.php") ?>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Track My Order</h3>
                    <hr>
                </div>
                <div class="col-lg-12 p-3 table-responsive" id="table-container">
                    <table class="table text-center">
                        <thead class="text-secondary">
                            <tr>
                                <th>Tracking No</th>
                                <th>Product</th>
                                <th>Subtotal</th>
                                <th>Delivery Fee</th>
                                <th>Total Price</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="trackingTable">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-primary" id="cancelOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to cancel your order?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnCloseAgreeCancel" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
        <button type="button" id="btnAgreeCancel" class="btn btn-primary btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        prescoExecutePOST('api/TransactionController/getTracking', {
            "email": Cookies.get("email")
        }, function(res){
            if (res.response.length != 0) {
                let trackingids = []
                let trackinginfo = []
                
                res.response.forEach(tracking => {
                    if (!trackingids.includes(tracking.tracking_id)) {
                        let products = []
                        res.response.forEach(product => {
                            !(tracking.tracking_id == product.tracking_id) || products.push({
                                "product_name" : product.product_name,
                                "product_image" : product.image,
                                "quantity" : product.quantity
                            });
                        });

                        trackingids.push(tracking.tracking_id);
                        trackinginfo.push({
                                "trackingid" : tracking.tracking_id,
                                "subtotal" : tracking.price,
                                "deliveryFee" : tracking.delivery_fee,
                                "total" : tracking.total_price,
                                "date" : tracking.created_date,
                                "status" : tracking.status,
                                "products" : products,
                                "createdDate" : tracking.created_date
                            }
                        )
                    }
                    
                });

                trackinginfo.forEach(info => {
                    let productColumn = "";
                    let status = "";

                    info.products.forEach(product => {
                        productColumn += `<li class="d-flex align-items-center" style="max-width: 300px"><div class="order-product-list-img"><img src="${base_url + product.product_image}"/></div><p class="mx-3 order-product-list-name">${product.product_name} x ${product.quantity}</p></li>`;
                    });

                    status = info.status == "1" ? `<button tracking-id="${info.trackingid}" class="btn btn-danger btn-sm btnCancel" data-bs-target="#cancelOrder" data-bs-toggle="modal">Cancel</button>` : info.status == "2" ? "Awaiting Shipment" : info.status == "3" ? "Awaiting Pickup" : info.status == "4" ? "Shipped" : info.status == "5" ? "Completed" : "Cancelled"

                    $("#trackingTable").append(`
                        <tr class="text-primary">
                            <td>${info.trackingid}</td>
                            <td>
                            <ul>
                            ${
                                productColumn
                            }
                            </ul>
                            </td>
                            <td>&#8369; ${info.subtotal}</td>
                            <td>&#8369; ${info.deliveryFee}</td>
                            <td>&#8369; ${info.total}</td>
                            <td>${info.createdDate}</td>
                            <td>${status}</td>
                        </tr>
                    `);
                });
            }else {
                $("#table-container").html(`<h4 class="text-primary">Your order will appear here.</h4>`);
            }

            $(".btnCancel").unbind("click").on("click", function(e){
                $("#btnAgreeCancel").attr('tracking-id', $(e.target).attr('tracking-id'));

                $("#btnAgreeCancel").unbind("click").on("click", function(e){
                    const trackingID = $("#btnAgreeCancel").attr('tracking-id');
                    
                    const payload = {
                        "tracking_id" : trackingID
                    }

                    prescoExecutePOST("api/BuyerController/cancelOrder", payload, function(res){
                        if (res.status == "Success") {
                            $("#toastAddToCart").html(toast("Success", res.message))
                            $('.toast').toast('show');
                        }else {
                            $("#toastAddToCart").html(toast("Failed", "An error occurred while cancelling your order, please refresh the page."))
                            $('.toast').toast('show');
                        }

                        $("#btnCloseAgreeCancel").click();
                    });
                });
            });
        });
    });
</script>