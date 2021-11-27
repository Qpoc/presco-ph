$(document).ready(function () {
	prescoExecuteGET("api/ProductController/getProduct", function (response) {
		var data = JSON.parse(response);
     
        data.response.forEach(product => {
            $("#card-section").append(`
                <div class="col-lg-4 product-container-home" product-id = ${product.product_id}>
                    <div class="card mx-3 shadow-lg">
                        <div class="product-image">
                            <img src="${base_url + product.image}" class="card-img-top" alt="...">
                            <div class="wishlist-container d-flex flex-column align-items-center justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                </svg>
                                <h2>Add to Wishlist</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">${product.product_name} <sup class="text-secondary fw-light" style="font-size: 12px;">${product.stocks} Pieces available</sup></h5>
                            <div class="product-description text-secondary">
                                <p class="card-text">${product.description}</p>
                            </div>
                            <p class="text-secondary">&#8369; <span class="product-price">${product.price}</span></p>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <button class="btn btn-sm btn-primary mx-3 btnBuyNow">Buy Now</button>
                            <button class="btn btn-sm btn-primary mx-3 btnAddToCart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            `); 
        });
        
        $(".btnAddToCart").unbind("click").on("click", function (e) { 
            const btnAddToCart = $(e.target);
            const productContainer = btnAddToCart.closest(".product-container-home");
            const productID = btnAddToCart.closest(".product-container-home").attr("product-id");

            const payload = {
                "email" : Cookies.get("email"),
                "productId" : productID,
                "quantity" : "1",
                "price": productContainer.find(".product-price").text()
            }

            prescoExecutePOST("api/ProductController/addToCart", payload, function (res) {
                console.log(res);
            });
        });
        
	});
});
