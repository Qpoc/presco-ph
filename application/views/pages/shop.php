<div>   
    <div id="shopCategory" class="d-flex flex-wrap text-center justify-content-center shop-category mt-3">
        
    </div>
</div>
<script>
    $(document).ready(function(){
        prescoExecuteGET("api/ProductController/getCategory", function (res) {
            if (res.status == "Success") {
                res.response.forEach(element => {
                    $("#shopCategory").append(`
                    <div class="shop-category-img mx-3 my-3 rounded" category-type="${element.category_type}">
                        <img src="${element.category_icon}" alt="">
                        <div class="shop-category-content">
                            <div class="shop-category-title">
                                <h1>${element.category_name}</h1>
                            </div>
                            <div class="shop-category-text">
                                <p>${element.message}</p>
                            </div>
                        </div>
                    </div>`);
                });

                $(".shop-category-img").unbind("click").on("click", function (e) {
                    let btnCategory = $(this);
                    let categoryType = btnCategory.attr("category-type");
                    let categoryName = btnCategory.find('.shop-category-content > .shop-category-title').find("h1").html();
                    
                    let payload = {
                        "categoryType" : categoryType,
                        "categoryName" : categoryName
                    };

                    prescoExecutePOST("api/ProductController/initCategoryDetails", payload, function (res) {
                        
                    });
                    
                    window.location.href = base_url + "category";
                });
            }
        });
    });
</script>
