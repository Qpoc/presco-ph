<div class="col-lg-12 p-3">
    <div class="d-flex align-items-start justify-content-start ms-5" id="card-section">
        
    </div>
</div>
<script>
    $(document).ready(function () { 
        let payload = {
            "email" : Cookies.get("email")
        }
        
        if (Cookies.get("email") !== undefined) {
            getWishlistProduct();
        }else{
            const wishlistItem = []
            getProduct(wishlistItem)
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
                        <button class="btn btn-sm btn-primary ms-auto">View My Shopping Cart</button>
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

        function getProduct(wishlistItem) {
            prescoExecuteGET("api/ProductController/getCategoryDetails", function (res) {
                if (res.status == "Success") {
                    res.response.forEach(product => {
                        $("#card-section").append(`
                            <div class="product-container-home product-container-shop" product-id="${product.product_id}">
                                <div class="card mx-3 shadow-lg">
                                    <div class="product-image">
                                        <img src="${base_url + product.image}" class="card-img-top" alt="...">
                                        <div class="wishlist-container d-flex flex-column align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-heart-fill ${wishlistItem.includes(product.product_id) ? 'added-to-wishlist' : ''}" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                            </svg>
                                            <h4>Add to Wishlist</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-title text-primary fw-bold">${product.product_name}</p>
                                        <input type="hidden" class="product-name" value="${product.product_name}"/>
                                        <div class="product-description text-secondary">
                                            <p class="card-text">${product.description}</p>
                                        </div>
                                        <p class="text-secondary">&#8369; <span class="product-price">${product.price}</span></p>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-center">
                                        <button class="btn btn-sm btn-primary mb-1 btnBuyNow">Buy Now</button>
                                        <button class="btn btn-sm btn-primary my-1 btnAddToCart">Add to Cart</button>
                                        <button class="btn btn-sm btn-primary my-1 btnDetails">Details</button>
                                    </div>
                                </div>
                            </div>
                        `);
                    })

                    $(".bi-heart-fill").unbind("click").on("click", function (e) { 
                        if (Cookies.get("email") !== undefined) {
                            const btnWishlist = $(e.target);
                            const productID = btnWishlist.closest('.product-container-home').attr('product-id');
                            const isWishlist = btnWishlist.closest('.product-container-home').find(".bi-heart-fill")
                            let payload;
                    
                            if (isWishlist.hasClass('added-to-wishlist')) {
                                payload = {
                                    'email' : Cookies.get("email"),
                                    'productId' : productID,
                                    'removeItem' : true
                                }
                                prescoExecutePOST('api/WishListController/addWishList', payload, function (res) { 
                                    if (res.status == "Success") {
                                        isWishlist.removeClass("added-to-wishlist")
                                    }
                                });
                            }else{
                                payload = {
                                    'email' : Cookies.get("email"),
                                    'productId' : productID
                                }
                                prescoExecutePOST('api/WishListController/addWishList', payload, function (res) { 
                                    if (res.status == "Success") {
                                        isWishlist.addClass("added-to-wishlist")
                                    }
                                });
                            }
                        }else{
                            window.location.replace(base_url + '/login')
                        }
                    });

                    $(".btnBuyNow").unbind("click").on("click", function (e) { 
                        if (Cookies.get("email") !== undefined) {
                            const btnAddToCart = $(e.target);
                            const productContainer = btnAddToCart.closest(".product-container-home");
                            const productID = btnAddToCart.closest(".product-container-home").attr("product-id");
                            console.log(productID);
                            const payload = {
                                "email" : Cookies.get("email"),
                                "productid" : productID,
                            }

                            const productName = productContainer.find(".product-name").val();
            
                            prescoExecutePOST("api/ProductController/shipping", payload, function (res) {
                                // if (res.status == "Success") {
                                //     $("#cartItems").html("");
                                //     const cart = {
                                //         "email" : Cookies.get('email') ? Cookies.get('email') : null
                                //     }
            
                                //     getCart(cart);
            
                                //     $("#toastAddToCart").html(`
                                //             <div id="liveToast" class="toast bg-primary shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-animation="true">
                                //             <div class="toast-header">
                                //                 <strong class="me-auto text-primary">Add to Cart</strong>
                                //                 <small>Now</small>
                                //                 <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                //             </div>
                                //             <div class="toast-body text-secondary">
                                //                 ${productName + " " + "has been added to your cart."} 
                                //             </div>
                                //             </div>
                                //         `)
                                //     $('.toast').toast('show');
                                // }
                            });

                            window.location.href = base_url + "shipping";
                        }else{
                            window.location.replace(base_url + 'login')
                        }
                    });
                    
                    $(".btnAddToCart").unbind("click").on("click", function (e) { 
                        if (Cookies.get("email") !== undefined) {
                            const btnAddToCart = $(e.target);
                            const productContainer = btnAddToCart.closest(".product-container-home");
                            const productID = btnAddToCart.closest(".product-container-home").attr("product-id");
                            const payload = {
                                "email" : Cookies.get("email"),
                                "productId" : productID,
                                "quantity" : "1",
                                "price": productContainer.find(".product-price").text()
                            }
                            const productName = productContainer.find(".product-name").val();
            
                            prescoExecutePOST("api/ProductController/addToCart", payload, function (res) {
                                if (res.status == "Success") {
                                    $("#cartItems").html("");
                                    const cart = {
                                        "email" : Cookies.get('email') ? Cookies.get('email') : null
                                    }
            
                                    getCart(cart);
            
                                    $("#toastAddToCart").html(`
                                            <div id="liveToast" class="toast bg-primary shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-animation="true">
                                            <div class="toast-header">
                                                <strong class="me-auto text-primary">Add to Cart</strong>
                                                <small>Now</small>
                                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                            <div class="toast-body text-secondary">
                                                ${productName + " " + "has been added to your cart."} 
                                            </div>
                                            </div>
                                        `)
                                    $('.toast').toast('show');
                                }
                            });
                        }else{
                            window.location.replace(base_url + '/login')
                        }
                    });

                    $(".btnDetails").unbind("click").on("click", function (e) {
                        const btnDetails = $(e.target);
                        const productID = btnDetails.closest(".product-container-home").attr("product-id");
                        const payload = {
                            "productid" : productID
                        }
                        prescoExecutePOST("api/ProductController/initProductDetails", payload, function (res) {
                            
                        });

                        window.location.href = base_url + "viewProduct";
                    });
                }
            });
        }

        function getWishlistProduct() {
            prescoExecutePOST("api/WishListController/getWishList", payload, function (wishlist) {
                if (wishlist.status == "Success") {
                    let wishlistItem = wishlist.response.map(element => element.product_id);
                    getProduct(wishlistItem);
                }else{
                    const wishlistItem = []
                    getProduct(wishlistItem)
                }
            });
        }
    });
</script>