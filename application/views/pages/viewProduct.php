
<div class="col-lg-12">
    <div class="d-flex view-product-container justify-content-center pt-5 ps-5 pe-5">
        <div class="view-product-img">
            <img id="productImg" src="" alt="">
        </div>
        <div class="view-product-body mx-5">
            <div class="view-product-title">
                <h1 id="productName" class="text-primary view-product-name"></h1>
            </div>
            <div id="ratings" class="mb-3">

            </div>
            <div class="view-product-subtitle">
                <h4 id="productPrice" class="text-secondary view-product-name">/h4>
            </div>
            <div class="view-product-body-content mt-3">
                <div class="view-product-actions">
                    <div class="view-product-quantity d-flex">
                        <p class="text-secondary mt-1">Quantity: </p>
                        <input id="productQuantity" class="view-product-quantity-tf form-control form-control-sm" type="number" value="1" min="1" step="1">
                        <span id="productStocks" class="text-secondary mx-3 mt-1"> </span>
                    </div>
                </div>
                <div class="view-product-buttons d-flex mt-3">
                    <button class="btn btnBuyNow btn-primary btn-sm">Buy Now</button>
                    <button class="btn btn-primary btnAddToCart btn-sm ms-3">Add to Cart</button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-heart-fill mx-3" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 mt-3 d-flex flex-column justify-content-center align-items-center">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">Description</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-review-tab" data-bs-toggle="pill" data-bs-target="#pills-review" type="button" role="tab" aria-controls="pills-review" aria-selected="false">Ratings and Reviews</button>
        </li>
    </ul>
    <div class="tab-content ps-5 pe-5" id="pills-tabContent">
        <div class="text-start tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
            <p id="productDescription" class="text-secondary"></p>
        </div>
        <div class="tab-pane fade" style="min-width: 700px; max-width: 700px;" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
            <div class="rating-reports-container">
                <h4 class="text-primary"><span class="fw-bold" id="ratingsAve"></span> out of 5</h4>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item d-flex" role="presentation">
                        <button star-rating="all" class="btnFilterStar nav-link active btn-sm" id="pill-all-tab" data-bs-toggle="pill" data-bs-target="#pill-all" type="button" role="tab" aria-controls="pill-all" aria-selected="true">All</button>
                        <button star-rating="5" class="btnFilterStar nav-link btn-sm" id="pill-all-tab" data-bs-toggle="pill" data-bs-target="#pill-all" type="button" role="tab" aria-controls="pill-all" aria-selected="true">5 star<span star-rating="5" id="star5">(0)</span></button>
                        <button star-rating="4" class="btnFilterStar nav-link btn-sm" id="pill-all-tab" data-bs-toggle="pill" data-bs-target="#pill-all" type="button" role="tab" aria-controls="pill-all" aria-selected="true">4 star<span star-rating="4" id="star4">(0)</span></button>
                        <button star-rating="3" class="btnFilterStar nav-link btn-sm" id="pill-all-tab" data-bs-toggle="pill" data-bs-target="#pill-all" type="button" role="tab" aria-controls="pill-all" aria-selected="true">3 star<span star-rating="3" id="star3">(0)</span></button>
                        <button star-rating="2" class="btnFilterStar nav-link btn-sm" id="pill-all-tab" data-bs-toggle="pill" data-bs-target="#pill-all" type="button" role="tab" aria-controls="pill-all" aria-selected="true">2 star<span star-rating="2" id="star2">(0)</span></button>
                        <button star-rating="1" class="btnFilterStar nav-link btn-sm" id="pill-all-tab" data-bs-toggle="pill" data-bs-target="#pill-all" type="button" role="tab" aria-controls="pill-all" aria-selected="true">1 star<span star-rating="1" id="star1">(0)</span></button>
                    </li>
                </ul>
                <div class="tab-content ps-5 pe-5" id="pills-tabContent">
                    <div class="text-start tab-pane fade show active" id="pill-all" role="tabpanel" aria-labelledby="pill-all-tab">
                        <p id="productDescription" class="text-secondary"></p>
                    </div>
                </div>
            </div>
            <hr>
            <div id="reviewContainer">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        prescoExecuteGET("api/ProductController/getProductDetails",function(productid){
            const payload = {
                "productid" : productid
            };
            prescoExecutePOST("api/ProductController/getProduct", payload ,function (product){ 
                $("#star5").html(`(${product.response[0].stars[0]})`);
                $("#star4").html(`(${product.response[0].stars[1]})`);
                $("#star3").html(`(${product.response[0].stars[2]})`);
                $("#star2").html(`(${product.response[0].stars[3]})`);
                $("#star1").html(`(${product.response[0].stars[4]})`);
                
                let payload = {
                    "email" : Cookies.get('email'),
                    "productid" : product.response[0].product_id
                };
                let rating = "";
                if (product.response[0].rating != null) {
                    for (let index = 0; index < Math.floor(product.response[0].rating); index++) {
                        rating += `<i class="bi bi-star-fill text-primary"></i>`
                    }
                    for (let index = Math.floor(product.response[0].rating); index < 5; index++) {
                        rating += product.response[0].rating % 1 >= 0.5 && index == Math.floor(product.response[0].rating) ? `<i class="bi bi-star-half text-primary"></i>` : `<i class="bi bi-star text-primary"></i>`
                    }
                    

                    $("#ratingsAve").html(parseFloat(product.response[0].rating).toFixed(1));
                }else {
                    $("#ratingsAve").html(0);
                    rating = `<i class="bi bi-star text-primary"></i>
                    <i class="bi bi-star text-primary"></i>
                    <i class="bi bi-star text-primary"></i>
                    <i class="bi bi-star text-primary"></i>
                    <i class="bi bi-star text-primary"></i>`;
                }

                if (product.response[0].feedback != null) {
                    product.response[0].feedback.forEach(feedback => {
                        let feedbackRating = "";
                        if (feedback.rating != null) {
                            for (let index = 0; index < Math.floor(feedback.rating); index++) {
                                feedbackRating += `<i class="bi bi-star-fill text-primary"></i>`
                            }
                            for (let index = Math.floor(feedback.rating); index < 5; index++) {
                                feedbackRating += feedback.rating % 1 >= 0.5 && index == Math.floor(feedback.rating) ? `<i class="bi bi-star-half text-primary"></i>` : `<i class="bi bi-star text-primary"></i>`
                            }
                        }else {
                            feedbackRating = `<i class="bi bi-star text-primary"></i>
                            <i class="bi bi-star text-primary"></i>
                            <i class="bi bi-star text-primary"></i>
                            <i class="bi bi-star text-primary"></i>
                            <i class="bi bi-star text-primary"></i>`;
                        }
                        $("#reviewContainer").append(`
                        <div class="reviews d-flex flex-column">
                            <div class="stars">
                                ${feedbackRating}
                            </div>
                            <p class="text-primary">By: ${feedback.first_name} <sup>${feedback.feedback_created_date}</sup></p>
                            <p class="text-secondary">${feedback.message == "" ? "" : feedback.message}</p>
                        </div>
                        <hr>
                        `);
                    });
                }else{
                    $("#reviewContainer").html(`
                        <p class="text-secondary text-center">No ratings yet</p>
                    `);
                }

                $("#ratings").html(rating);
                $("#productImg").attr("src", product.response[0].image);
                $("#productName").html(product.response[0].product_name);
                $("#productPrice").html("&#8369; " + product.response[0].price);
                $("#productDescription").html(product.response[0].description);
                $("#productStocks").html(product.response[0].stocks + " piece available");

                prescoExecutePOST("api/WishListController/getWishList", payload, function (wishlist) {
                    if (wishlist.status == "Success") {
                        $(".bi-heart-fill").addClass('added-to-wishlist');
                    }
                });

                $(".bi-heart-fill").unbind("click").on("click", function (e) { 
                    if (Cookies.get("email") !== undefined) {
                        const btnWishlist = $(e.target);
                        const productID = product.response[0].product_id;
                        const isWishlist = btnWishlist.closest('.view-product-container').find(".bi-heart-fill");
                        let payload;
                
                        if (isWishlist.hasClass('added-to-wishlist')) {
                            payload = {
                                'email' : Cookies.get("email"),
                                'productId' : productID,
                                'removeItem' : true
                            }
                            prescoExecutePOST('api/WishListController/addWishList', payload, function (res) { 
                                if (res.status == "Success") {
                                    isWishlist.removeClass("added-to-wishlist");
                                }
                            });
                        }else{
                            payload = {
                                'email' : Cookies.get("email"),
                                'productId' : productID
                            }
                            prescoExecutePOST('api/WishListController/addWishList', payload, function (res) { 
                                if (res.status == "Success") {
                                    isWishlist.addClass("added-to-wishlist");
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
                        const productID = productid;
                    
                        const payload = {
                            "email" : Cookies.get("email"),
                            "productid" : productID,
                            "quantity" : parseInt($("#productQuantity").val())
                        }

                        const productName = $("#productName").val();
        
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
                        const productID = productid;

                        const payload = {
                            "email" : Cookies.get("email"),
                            "productId" : productID,
                            "quantity" : parseInt($("#productQuantity").val()),
                            "price": product.response[0].price
                        }
                        const productName = product.response[0].product_name;
        
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

            });

            var btnReview = document.querySelector('button[id="pills-review-tab"]')
            btnReview.addEventListener('shown.bs.tab', function (event) {
                $(".btnFilterStar").unbind("click").on("click", function(e){
                    
                    const rating = $(e.target).attr("star-rating");

                    const payload = {
                        "rating" : rating,
                        "productid" : productid
                    };

                    prescoExecutePOST("api/ReviewController/filterRating", payload, function(product){
                        $("#reviewContainer").html("");
                        if (product.response[0].feedback != null) {
                            product.response[0].feedback.forEach(feedback => {
                                $("#reviewContainer").html("");
                                if (product.response[0].feedback != null) {
                                    product.response[0].feedback.forEach(feedback => {
                                        let feedbackRating = "";
                                        if (feedback.rating != null) {
                                            for (let index = 0; index < Math.floor(feedback.rating); index++) {
                                                feedbackRating += `<i class="bi bi-star-fill text-primary"></i>`
                                            }
                                            for (let index = Math.floor(feedback.rating); index < 5; index++) {
                                                feedbackRating += feedback.rating % 1 >= 0.5 && index == Math.floor(feedback.rating) ? `<i class="bi bi-star-half text-primary"></i>` : `<i class="bi bi-star text-primary"></i>`
                                            }
                                        }else {
                                            feedbackRating = `<i class="bi bi-star text-primary"></i>
                                            <i class="bi bi-star text-primary"></i>
                                            <i class="bi bi-star text-primary"></i>
                                            <i class="bi bi-star text-primary"></i>
                                            <i class="bi bi-star text-primary"></i>`;
                                        }
                                        $("#reviewContainer").append(`
                                        <div class="reviews d-flex flex-column">
                                            <div class="stars">
                                                ${feedbackRating}
                                            </div>
                                            <p class="text-primary">By: ${feedback.first_name} <sup>${feedback.feedback_created_date}</sup></p>
                                            <p class="text-secondary">${feedback.message == "" ? "" : feedback.message}</p>
                                        </div>
                                        <hr>
                                        `);
                                    });
                                }else{
                                    $("#reviewContainer").html(`
                                        <p class="text-secondary text-center">No ratings yet</p>
                                    `);
                                }
                            })
                        }
                    });
                  
                });
            })
        });   
    })
</script>