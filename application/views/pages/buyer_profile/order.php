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

                    status = info.status == "1" ? "Pending" : info.status == "2" ? "Awaiting Shipment" : info.status == "3" ? "Awaiting Pickup" : info.status == "4" ? "Shipped" : info.status == "5" ? "Completed" : "Cancelled"

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
        });
    });
</script>