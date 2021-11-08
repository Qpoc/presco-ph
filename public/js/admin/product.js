$(document).ready(function () { 
    $("#btnAddProduct").unbind("click").on("click", function (e) { 

        var formData = new FormData();
    
        formData.append("productName", $("#productName").val());
        formData.append("imagePath", $("#productImage")[0].files[0]);
        formData.append("price", $("#productPrice").val());
        formData.append("stocks", $("#productStock").val());
        formData.append("description", CKEDITOR.instances['productDescription'].getData());
        formData.append("email", Cookies.get("email"));

        prescoExecuteFileUpload("api/ProductController/addProduct", formData, function (response) { 
        
        });
    });

});