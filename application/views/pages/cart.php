<style>
    #shipping-container {
        max-width: 100%;
    }
    .product-img {
        width: 80px;
        height: 80px;
    }
    .product-img img {
        max-width: 100%;
        max-height: 100%;
    }
    .product-name {
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
        max-width: 150px;
        -webkit-line-clamp: 2;
    }
</style>
<div class="row" id="shipping-container">
    <div class="col-lg-8 mt-5">
        <div class="row bg-primary shadow p-3" style="max-width: 800px; min-height: 112px;" id="shipping-products">
        </div>
    </div>
    <div class="col-lg-4 mt-5">
        <div class="row bg-primary shadow p-3" style="min-height: 112px;" id="shipping-info">
            
        </div>
    </div>
</div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script>
    $(document).ready(function(){
        let productsCheckout = [];
        const cart = {
            "email" : Cookies.get('email') ? Cookies.get('email') : null
        }
        
        prescoExecutePOST("api/ProductController/getCart", cart, function(res){
            if (res.status == "Success") {
                let subTotal = 0;
                let deliveryFee = 90;
                $("#shipping-products").append(`
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex mx-4">
                            <input id="selectAllCart" type="checkbox" class="form-check-input"/>
                            <label for="#selectAllCart" class="mx-4 form-check-label text-primary">Select all (${res.response.length} ITEM(S))</label>
                        </div>
                    </div>
                `);

                res.response.forEach(product => {
                    $("#shipping-products").append(`
                        <div class="col-lg-12 shipping-product" product-id="${product.product_id}">
                            <div class="row">
                                <div class="col-lg-1 d-flex align-items-center justify-content-end">
                                    <input type="checkbox" class="form-check-input checkbox-add-to-checkout"/>
                                </div>
                                <div class="col-lg-2">
                                    <div class="product-img">
                                        <img src="${product.image}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-9 product-info d-flex justify-content-between align-items-center">
                                    <div class="product-name" style="width: 100%;">
                                        <p class="fw-bold text-primary">${product.product_name}</p>
                                    </div>
                                    <div class="product-price">
                                        <p class="text-primary">&#8369; ${product.price}</p>
                                    </div>
                                    <div class="product-actions">
                                        <input style="width: 60px;" class="form-control form-control-sm product-quantity" type="number" min="1" step="1" value="${product.quantity}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)
                    subTotal += parseInt(product.price);
                });

                prescoExecutePOST("api/BuyerController/getBuyerInfo", {
                    "email" : Cookies.get("email")
                }, function(res){
                    res.response.forEach(info => {
                        $("#shipping-info").append(`
                            <div class="col-lg-12 mb-3">
                                <h5 class="fw-bold text-primary">Billing Information</h5>
                                <p class="text-primary">${info.first_name + " " + info.last_name}</p>
                                <p class="fw-bold text-primary">Location: <span class="fw-normal text-primary">${info.address}</span></p>
                                <p class="fw-bold text-primary">Contact: <span class="fw-normal text-primary">09447485874</span></p>
                                <p class="fw-bold text-primary">Email: <span class="fw-normal text-primary">${info.email}</span></p>
                                <hr>
                                <div id="nonCOD" class="row d-flex justify-content-center">
                                    <div class="col-lg-12">
                                        <h5 class="fw-bold text-primary">Summary</h5>
                                        <p class="sub-total fw-bold text-primary">Subtotal: <span id="txtSubTotal" class="fw-normal text-primary">&#8369; 0.00</span></p>
                                        <input type='hidden' id="subTotal" name="subTotal" value="0"/>
                                        <p class="delivery-fee fw-bold text-primary">Delivery Fee: <span id="txtDelFee" class="fw-normal text-primary">&#8369; 0.00</span></p>
                                        <input type='hidden' id="deliveryFee" name="deliveryFee" value="0"/>
                                        <hr>
                                        <p class="total fw-bold text-primary">Total: <span id="txtTotal" class="fw-normal text-primary">&#8369; 0.00</span></p>
                                        <input type='hidden' id="total" name="total" value="0"/>
                                    </div>
                                    <div class="col-lg-12 d-flex justify-content-end">
                                        <button id="btnProceedToCheckout" class="btn btn-primary btn-sm btn-lg btn-block" type="submit" disabled>Proceed to Checkout</button>
                                    </div>
                                </div>
                            </div>
                            
                        `);
                    })

                    $("#btnProceedToCheckout").unbind('click').on('click', function (e) { 
                        prescoExecutePOST('api/ProductController/shipping', productsCheckout, function(res){
                            
                        });
                        window.location.href = base_url + "/shipping";
                    });
                });

                $("#selectAllCart").unbind('change').on('change', function (e) {
                    if ($(e.target).is(':checked')) {
                        $(".checkbox-add-to-checkout").prop('checked', true);
                        $(".checkbox-add-to-checkout").each(function (e) {
                            console.log($(this).is(":checked"));
                        })
                    }else{
                        console.log("hello");
                        $(".checkbox-add-to-checkout").prop('checked', false);
                    }
                    computeTotalCost()
                });

                $(".checkbox-add-to-checkout").unbind('change').on('change', function (e) { 
                    computeTotalCost()
                });

                $(".product-quantity").unbind('change').on('change', function (e) { 
                    computeTotalCost()
                });
            }
        });

        function computeTotalCost() { 
            let subTotal = 0.00;
            let delFee = 90.00;
            productsCheckout = [];

            $(".checkbox-add-to-checkout").each(function (e) {
                if ($(this).is(":checked")) {
                    const price = $(this).closest(".row").find('.product-price > p').html().split(' ')[1];
                    const quantity = $(this).closest(".row").find('.product-actions > input').val();
                    const productName = $(this).closest('.shipping-product').find('.product-name > p').html();

                    subTotal += parseFloat(price) * parseFloat(quantity);
                    
                    productsCheckout.push({
                        "id" : $(this).closest('.shipping-product').attr('product-id'),
                        "product_name" : productName,
                        "image" : $(this).closest('.shipping-product').find('.product-img > img').attr('src'),
                        "price" : price,
                        "quantity" : quantity,
                        "subTotal" : subTotal,
                        "viewCart" : true
                    });
                }
            });

            delFee = subTotal != 0 ? delFee : 0.00;
            $('#txtSubTotal').html(`&#8369; ${subTotal}.00`);
            
            $('#txtDelFee').html(`&#8369; ${delFee}.00`);
            const total = subTotal + delFee;
            $('#txtTotal').html(`&#8369; ${total}.00`);

            $('#subTotal').val(subTotal);
            $('#deliveryFee').val(delFee);
            $('#total').val(total);

            console.log($('#total').val());

            if (total <= 0) {
                $("#btnProceedToCheckout").attr('disabled', true);
            }else{
                $("#btnProceedToCheckout").removeAttr('disabled');
            }
        }
    });
</script>