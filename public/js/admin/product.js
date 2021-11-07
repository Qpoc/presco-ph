$(document).ready(function () { 
    $("#btnAddProduct").unbind("click").on("click", function (e) { 

        const formData = new FormData();

        formData.append("imagePath", document.getElementById("productImage").files[0]);

        const payload = {
            "productName" : $("#productName").val(),
            "imagePath" : formData,
            "price" : $("#productDescription").val(),
            "stocks" : $("#productPrice").val(),
            "description" : $("#productStock").val(),
            "email" : $("#productName").val()
        }

        console.log(payload);
    });
});