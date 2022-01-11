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
        
        prescoExecuteGET("api/ProductController/loadShipping", function(res){
            res.response.forEach(product => {
                $("#shipping-products").append(`
                    <div class="col-lg-12 shipping-product" product-id="${product.product_id   }">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="product-img">
                                    <img src="${product.image}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-10 product-info d-flex justify-content-between align-items-center">
                                <div class="product-name" style="width: 100%;">
                                    <p class="fw-bold text-primary">${product.product_name}</p>
                                </div>
                                <div class="product-price">
                                    <p class="text-primary">&#8369; ${product.price}</p>
                                </div>
                                <div class="product-actions">
                                    <input style="width: 60px;" class="form-control form-control-sm product-quantity" type="number" min="1" step="1" value="${product.viewCart ? product.quantity : 1}">
                                </div>
                            </div>
                        </div>
                    </div>
                `)
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
                            <div>
                                <select class="form-select form-select-sm" name="" id="MOP">
                                    <option value="" disabled>Select Mode of Payment</option>
                                    <option value="1" selected>Cash on Delivery</option>
                                    <option value="2">Debit/Credit Card</option>
                                </select>
                            </div>
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
                                    <button class="btn btn-primary btn-sm btn-lg btn-block" type="submit">Place Order</button>
                                </div>
                            </div>
                        </div>
                        
                    `);
                })

                $("#MOP").unbind('change').on("change", function (e) {
                    if ($(e.target).val() == "2") {
                        $("#nonCOD").html(`
                            <div class="col-md-12">
                                <?php if($this->session->flashdata('success')){ ?>
                                <div class="alert alert-success text-center">
                                    <p><?php echo $this->session->flashdata('success'); ?></p>
                                </div>
                                <?php } ?>
                                <form role="form" action="<?php echo base_url('handleStripePayment');?>" method="post"
                                    class="form-validation" data-cc-on-file="false"
                                    data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
                                    id="payment-form">
                                    <div class='form-row row my-3'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Name on Card</label>
                                            <input class='form-control form-control-sm' size='4' type='text'>
                                        </div>
                                    </div>
                                    <div class='form-row row my-3'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Card Number</label>
                                            <input autocomplete='off' class='form-control form-control-sm card-number' size='20' type='text'>
                                        </div>
                                    </div>
                                    <div class='form-row row gy-3'>
                                        <div class='col-xs-12 col-md-6 form-group cvc required'>
                                            <label class='control-label'>CVC</label>
                                            <input autocomplete='off' class='form-control form-control-sm card-cvc' placeholder='ex. 311'
                                                size='4' type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-6 form-group expiration required'>
                                            <label class='control-label'>Expiration Month</label>
                                            <input class='form-control form-control-sm card-expiry-month' placeholder='MM' size='2' type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-6 form-group expiration required'>
                                            <label class='control-label'>Expiration Year</label>
                                            <input class='form-control form-control-sm card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                        </div>
                                    </div>
                                    <div class='form-row row my-3'>
                                        <div class='col-md-12 error form-group d-none'>
                                            <div class='alert-danger alert'></div>
                                        </div>
                                    </div>
                                    <hr>
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
                                        <button class="btn btn-primary btn-sm btn-lg btn-block" type="submit">Place Order</button>
                                    </div>
                                </form>
                            </div>
                        `);
                        var $stripeForm = $(".form-validation");
                        $('form.form-validation').bind('submit', function (e) {
                            e.preventDefault();
                            var $stripeForm = $(".form-validation"),
                                inputSelector = ['input[type=email]', 'input[type=password]',
                                    'input[type=text]', 'input[type=file]',
                                    'textarea'
                                ].join(', '),
                                $inputs = $stripeForm.find('.required').find(inputSelector),
                                $errorMessage = $stripeForm.find('div.error'),
                                valid = true;
                            $errorMessage.addClass('d-none');

                            $('.has-error').removeClass('has-error');
                            $inputs.each(function (i, el) {
                                var $input = $(el);
                                if ($input.val() === '') {
                                    $input.parent().addClass('has-error');
                                    $errorMessage.removeClass('d-none');
                                    e.preventDefault();
                                }
                            });

                            if (!$stripeForm.data('cc-on-file')) {
                                e.preventDefault();
                                Stripe.setPublishableKey($stripeForm.data('stripe-publishable-key'));
                                Stripe.createToken({
                                    number: $('.card-number').val(),
                                    cvc: $('.card-cvc').val(),
                                    exp_month: $('.card-expiry-month').val(),
                                    exp_year: $('.card-expiry-year').val()
                                }, stripeResponseHandler);
                            }

                        });
                        function stripeResponseHandler(status, res) {
                            if (res.error) {
                                $('.error')
                                    .removeClass('d-none')
                                    .find('.alert')
                                    .text(res.error.message);
                            } else {
                                var token = res['id'];
                                $stripeForm.find('input[type=text]').empty();
                                $stripeForm.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                                $stripeForm.get(0).submit();
                            }
                        }
                    }else {
                        $("#nonCOD").html(`
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
                                <button class="btn btn-primary btn-sm btn-lg btn-block">Place Order</button>
                            </div>
                        `);
                    }
                    computeTotalCost();
                });
                
                $(".product-quantity").unbind('change').on('change', function (e) { 
                    computeTotalCost();
                });

                computeTotalCost();

            });
        });

        function computeTotalCost() { 
            let subTotal = 0.00;
            let delFee = 90.00;
            productsCheckout = [];

            $(".shipping-product").each(function (e) {
                const price = $(this).find('.product-price > p').html().split(' ')[1];
                const quantity = $(this).find('.product-actions > input').val();
                const productName = $(this).find('.product-name > p').html();
                
                subTotal += parseFloat(price) * parseFloat(quantity);
                console.log(subTotal);
                productsCheckout.push({
                    "id" : $(this).closest('.shipping-product').attr('product-id'),
                    "product_name" : productName,
                    "image" : $(this).closest('.shipping-product').find('.product-img > img').attr('src'),
                    "price" : price,
                    "quantity" : quantity,
                    "subTotal" : subTotal,
                    "bulkPlaceOrder" : true
                });
            });

            delFee = subTotal != 0 ? delFee : 0.00;
            $('#txtSubTotal').html(`&#8369; ${subTotal}.00`);
            
            $('#txtDelFee').html(`&#8369; ${delFee}.00`);
            const total = subTotal + delFee;
            $('#txtTotal').html(`&#8369; ${total}.00`);

            $('#subTotal').val(subTotal);
            $('#deliveryFee').val(delFee);
            $('#total').val(total);
        }
    });
</script>