<?php require("profile_navigation.php") ?>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Wishlist</h3>
                    <hr>
                </div>
                <!-- <div class="col-lg-12">
                    <button class="btn btn-sm btn-primary">Add All to Cart</button>
                </div> -->
                <div class="col-lg-12 p-3 table-responsive">
                    <table class="table text-center">
                        <thead class="text-secondary">
                            <tr>
                                <th>Product</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="wishlistTable">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        prescoExecutePOST("api/WishListController/getWishList", {
            "email" : Cookies.get('email')
        }, function (wishlists) {
            if (wishlists.status == "Success") {
                wishlists.response.forEach(wishlist => {
                    $("#wishlistTable").append(`
                        <tr product-name="${wishlist.product_name}" product-id="${wishlist.product_id}" price="${wishlist.price}">
                            <td class="d-flex flex-column align-items-center justify-content-center">
                                <div class="wishlist-product-list-img" style="min-height: 64px; height: 64px; min-width: 64px; width: 64px;">
                                    <img src="${base_url + wishlist.image}" style="max-width: 100%; max-height: 100%;"/>
                                </div>
                                <p class="wishlist-product-list-name">${wishlist.product_name}</p>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary btnAddtoCart">Add to Cart</button>
                            </td>
                        </tr>
                    `);
                });
                $(".btnAddtoCart").unbind('click').on('click', function(e){
                    let productID = $(e.target).closest('tr').attr('product-id');
                    let price = $(e.target).closest('tr').attr('price');
                    let productName = $(e.target).closest('tr').attr('product-name');

                    var payload = {
                        "email" : Cookies.get('email'),
                        "productId": productID,
                        "price": price,
                        "quantity": 1
                    }

                    prescoExecutePOST("api/ProductController/addToCart", payload , function(res){
                        if (res.status == "Success") {
                            $("#toastAddToCart").html(toast("Add to Cart", `${productName} has been added to your cart.`))
                            $('.toast').toast('show');

                            getCart({
                                "email" : Cookies.get("email") ?? null
                            })
                        }
                    })

                })
            }

        });
    })
</script>