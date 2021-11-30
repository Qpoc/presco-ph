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

    $("#btnAddProduct").unbind("click").on("click", function (e) { 

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

        prescoExecuteFileUpload("api/ProductController/addProduct", formData, function (response) { 
        
        });
    });

    $("#btnAddCategory").unbind("click").on("click", function(e){
        var formData = new FormData();
        
        formData.append("category_type", $("#parentCategory").val());
        formData.append("category_name", $("#category").val());
        formData.append("category_icon", $("#categoryIcon")[0].files[0]);
        formData.append("category_bg", $("#categoryBackground")[0].files[0]);

        console.log(formData);

        prescoExecuteFileUpload("api/AdminController/addCategory", formData, function (response) { 
            
        });
    });

});