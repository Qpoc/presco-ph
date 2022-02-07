$(document).ready(function () { 
    $("#btnMAddProduct").unbind("click").on("click", function(e){
        $("#categoryType").html(`<option value="" disabled selected>Select Type</option>`);
        $("#category").html(`<option value="" disabled selected>Select Category</option>`);

        prescoExecuteGET("api/AdminController/getCategory", function (res) {
            let category_type_map = new Map();
            let category_type = [];
            let category_name = [];
            res.response.forEach(category => {
                if (!category_type.includes(category.category_type)) {
                    category_type.push(category.category_type)
                    category_name.push(category.category_name)
                    category_type_map.set(category.category_type, category_name)
                }else{
                    let value = category_type_map.get(category.category_type);
                    value.push(category.category_name);
                    category_type_map.set(category.category_type, value)
                }
            }); 

            if (res.response.length > 0) {

                for (const key of category_type_map.keys()) {
                    $("#categoryType").append(`<option value="${key}">${key}</option>`)
                }
                $("#categoryType").unbind("change").on("change", function(e) {
                    category_type_map.get($("#categoryType").val()).forEach(category => {
                        $("#category").append(`<option value="${category}">${category}</option>`);
                    })
                })
            }
        });
    });

    $("#addProductForm").submit(function (e) {
        e.preventDefault();
        var formData = new FormData();
    
        formData.append("productName", $("#productName").val());
        formData.append("imagePath", $("#productImage")[0].files[0]);
        formData.append("price", $("#productPrice").val());
        formData.append("stocks", $("#productStock").val());
        formData.append("description", CKEDITOR.instances['productDescription'].getData());
        formData.append("email", Cookies.get("email"));
        formData.append("category_type", $("#categoryType").val())
        formData.append("category_name", $("#category").val());
        formData.append("featured", $("#featured").val());

        prescoExecuteFileUpload("api/ProductController/addProduct", formData, function (res) { 
            if (res.status == "Success") {
                $("#toastAddToCart").html(`
                    <div id="liveToast" class="toast bg-primary shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-animation="true">
                    <div class="toast-header">
                        <strong class="me-auto text-primary">Success</strong>
                        <small>Now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body text-secondary">
                        ${$("#productName").val() + " " + "successfully added, please refresh the page."} 
                    </div>
                    </div>
                `)
                $('.toast').toast('show');

                $('#addProductForm').trigger("reset");
            }else{
                if (!res.file_size) {
                    $("#toastAddToCart").html(toast("Failed", "Your uploaded file must not exceed 2mb."));
                    $(".toast").toast("show");
                }
            }

            $("#btnAddProductClose").click();
            
        });
    });

    $("#addCategoryForm").submit(function(e){
        e.preventDefault();
        var formData = new FormData();
        
        formData.append("category_type", $("#parentCategory").val());
        formData.append("category_name", $("#category").val());
        formData.append("category_icon", $("#categoryIcon")[0].files[0]);
        formData.append("category_bg", $("#categoryBackground")[0].files[0]);

        console.log(formData);

        prescoExecuteFileUpload("api/AdminController/updateCategory", formData, function (res) { 
            console.log(res);
        });
    });

    prescoExecuteGET('api/ProductController/getProduct', function(res){
        console.log(res);
        let data = [];

        res.response.forEach(product => {
            data.push([
                `
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="edit-image-product" style="max-height: 64px; max-width: 64px;">
                            <img src="${base_url + product.image}" style="height: 100%; width: 100%;"/>
                        </div>
                        <p>${product.product_name}</p>
                    </div>
                `,
                product.price,
                product.stocks,
                product.product_created_date,
                `<button data-bs-toggle="modal" data-bs-target="#M_editCategory"  product-info="${product.product_id}" class="btnEditProduct btn btn-sm btn-primary">Edit</button>`
            ]);
        });

        $("#productTable").DataTable({
            data : data,
            pageLength: 10
        });

        $(".btnEditProduct").unbind('click').on('click', function(e){
            let productID = $(e.target).attr('product-info');
            
            let payload = {
                "productid" : productID
            }

            prescoExecutePOST('api/ProductController/getProduct', payload, function(res){
                if (res.status == "Success") {
                    $("#categoryTypeEdit").html(`<option value="" disabled selected>Select Type</option>`);
                    $("#categoryEdit").html(`<option value="" disabled selected>Select Category</option>`);

                    prescoExecuteGET("api/AdminController/getCategory", function (res) {
                        let category_type_map = new Map();
                        let category_type = [];
                        let category_name = [];
                        res.response.forEach(category => {
                            if (!category_type.includes(category.category_type)) {
                                category_type.push(category.category_type)
                                category_name.push(category.category_name)
                                category_type_map.set(category.category_type, category_name)
                            }else{
                                let value = category_type_map.get(category.category_type);
                                value.push(category.category_name);
                                category_type_map.set(category.category_type, value)
                            }
                        }); 

                        if (res.response.length > 0) {

                            for (const key of category_type_map.keys()) {
                                $("#categoryTypeEdit").append(`<option value="${key}">${key}</option>`)
                            }
                            $("#categoryTypeEdit").unbind("change").on("change", function(e) {
                                category_type_map.get($("#categoryTypeEdit").val()).forEach(category => {
                                    $("#categoryEdit").append(`<option value="${category}">${category}</option>`);
                                })
                            })
                        }
                    });
                    res.response.forEach(product => {
                        console.log(product);
                        $("#productNameEdit").val(product.product_name)
                        CKEDITOR.instances['productDescriptionEdit'].setData(product.description)
                        $("#productPriceEdit").val(product.price);
                        $("#productStockEdit").val(product.stocks);
                        $("#featuredEdit").val(product.featured)
                    });

                    $("#editProductForm").submit(function(e){
                        e.preventDefault();
                        var formData = new FormData();
    
                        formData.append("product_id", productID);
                        formData.append("productName", $("#productNameEdit").val());
                        formData.append("imagePath", $("#productImageEdit")[0].files[0]);
                        formData.append("price", $("#productPriceEdit").val());
                        formData.append("stocks", $("#productStockEdit").val());
                        formData.append("description", CKEDITOR.instances['productDescriptionEdit'].getData());
                        formData.append("email", Cookies.get("email"));
                        formData.append("category_type", $("#categoryTypeEdit").val())
                        formData.append("category_name", $("#categoryEdit").val());
                        formData.append("featured", $("#featuredEdit").val());

                        prescoExecuteFileUpload("api/ProductController/updateProduct", formData, function (res) { 
                            if (res.status == "Success") {
                                $("#toastAddToCart").html(`
                                    <div id="liveToast" class="toast bg-primary shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-animation="true">
                                    <div class="toast-header">
                                        <strong class="me-auto text-primary">Success</strong>
                                        <small>Now</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body text-secondary">
                                        ${$("#productNameEdit").val() + " " + "successfully edited, please refresh the page."} 
                                    </div>
                                    </div>
                                `)
                                $('.toast').toast('show');
                            }else{
                                if (!res.file_size) {
                                    $("#toastAddToCart").html(toast("Failed", "Your uploaded file must not exceed 2mb."));
                                    $(".toast").toast("show");
                                }
                            }

                            $("#btnAddProductEditClose").click();
                        });
                    });
                }
            });
        });
    });

});