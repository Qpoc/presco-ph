$(document).ready(function () { 
    var navigation = $("#presco-navigation");

    navigation.unbind("click").on("click", function (e) { 
       const nav = $(e.target);
       
       if (nav.is(":checked")) {
            setTimeout(function () { 
                $(".navigation-container").removeClass("col-lg-2").addClass("d-none");
                $(".main-content").removeClass("col-lg-10").addClass("col-lg-12");
            },500);
       }else {
            $(".navigation-container").removeClass("d-none").addClass("col-lg-2");
            $(".main-content").removeClass("col-lg-12").addClass("col-lg-10");
       }
    })

    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl)
    })

    if (Cookies.get("email") !== undefined) {
        const cart = {
            "email" : Cookies.get('email') ? Cookies.get('email') : null
        }
        
        getCart(cart);
        
    }else if(Cookies.get("email") === undefined){
        $("#cartItems").append(`<div class="cart-item-header">
            <h6 class="text-secondary">Only registered users can add to cart. Please Sign in or create an account</h6>
        </div>`);
    }

    function getCart(cart) {
        prescoExecutePOST("api/ProductController/getCart", cart, function (res) { 
            if (res.status == "Success") {
                $("#cartItems").html("");
                $("#cartNumber").text(res.response.length);
                $("#cartItems").append(`<div class="cart-item-header">
                    <h6 class="text-secondary">Added Products</h6>
                </div>`);
                $("#cartItems").append(`<div id="cartItem" class="cart-item-body d-flex flex-column">          
                </div>`);
                res.response.forEach(item => {
                    $("#cartItem").append(`<div class="cart-item my-1 d-flex align-items-center" product-id="${item.product_id}">
                        <div class="cart-item-img">
                            <img src="${base_url + item.image}" alt="">
                        </div>
                        <div class="cart-item-name mx-3 d-flex flex-column">
                            <div class="d-flex flex-column">
                                <p class="d-block text-truncate text-primary m-0" style="max-width: 175px;">${item.product_name}</p>
                                <div class="d-flex align-items-center cart-action">
                                    <p class="text-secondary m-0">&#8369; <span class="cart-item-price">${item.price}</span></p>
                                    <input type="hidden" value="${item.quantity}"/>
                                    <input type="number" class="form-control form-control-sm ms-1 inCartNumber" value="${item.quantity}" min="1" max="100" step="1" pattern="\d*" oninput="this.value= ['','-'].includes(this.value) ? this.value : this.value|0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi delete-cart bi-trash-fill text-danger mx-1" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>`)
                });
                $("#cartItems").append(`<hr>
                <div class="cart-item-button my-1 d-flex justify-content-end">
                    <a href=${base_url}cart class="text-primary btn btn-sm btn-primary">View My Shopping Cart</a>
                </div>`)
                $(".inCartNumber").unbind("change keyup").on("change keyup", function(e){
                    const inCartNumber = $(e.target);
    
                    if (inCartNumber.val() > inCartNumber.prev().val()) {
                        const productContainer = inCartNumber.closest(".cart-item");
                        const productID = inCartNumber.closest(".cart-item").attr("product-id");
                        const payload = {
                            "email" : Cookies.get("email"),
                            "productId" : productID,
                            "quantity" : inCartNumber.val(),
                            "price": productContainer.find(".cart-item-price").text(),
                        }

                        prescoExecutePOST("api/ProductController/addToCart", payload, function (res) {});

                        inCartNumber.prev().val(inCartNumber.val());
                    }else if (inCartNumber.val() < inCartNumber.prev().val()) {
                        const productContainer = inCartNumber.closest(".cart-item");
                        const productID = inCartNumber.closest(".cart-item").attr("product-id");
                        const payload = {
                            "email" : Cookies.get("email"),
                            "productId" : productID,
                            "quantity" : inCartNumber.val(),
                            "price": productContainer.find(".cart-item-price").text(),
                            "decreaseQuantity" : true
                        }

                        prescoExecutePOST("api/ProductController/addToCart", payload, function (res) {});

                        inCartNumber.prev().val(inCartNumber.val());
                    }
                });
                $(".delete-cart").unbind("click").on("click", function (e) {
                    const btnDelete = $(e.target);

                    const productContainer = btnDelete.closest(".cart-item");
                    const productID = btnDelete.closest(".cart-item").attr("product-id");
                    const payload = {
                        "email" : Cookies.get("email"),
                        "productId" : productID,
                        "quantity" : btnDelete.val(),
                        "price": productContainer.find(".cart-item-price").text(),
                        "deleteItem": true
                    }

                    prescoExecutePOST("api/ProductController/addToCart", payload, function (res) {
                        prescoExecutePOST("api/ProductController/getCart", email, function (res) {
                            if (res.status != "Success") {
                                $("#cartItems").html("");
                                $("#cartItems").append(`<div class="cart-item-header">
                                    <h6 class="text-secondary">Your added products will appear here.</h6>
                                </div>`);
                                $("#cartNumber").text(0);
                            }else {
                                $("#cartNumber").text(res.response.length);
                            }
                            getCart(email);
                        })
                    });

                    const email = {
                        "email" : Cookies.get("email")
                    }

                })
            }else {
                $("#cartItems").html("");
                $("#cartItems").append(`<div class="cart-item-header">
                    <h6 class="text-secondary">Your added products will appear here.</h6>
                </div>`);
            }
        });
    }

});