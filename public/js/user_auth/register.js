$(document).ready(function () { 

    $("#birthDate").datepicker({
        format: 'yyyy/mm/dd',
    });

    $("#registerForm").submit(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
     
        var approval = true; 

        $('.auth-regis').each(function(e){
            if ($(this).val().length == 0) {
                $(this).addClass('border-danger');
                approval = false;
            }else{
                $(this).removeClass('border-danger');
            }
        });

        $('.auth-down').each(function(e){
            if ($(this).val() == null) {
                $(this).addClass('border-danger');
                approval = false;
            }else{
                $(this).removeClass('border-danger');
            }
        });


        if(approval){
            const firstName = $("#firstName").val();
            const lastName = $("#lastName").val();
            const birthDate = $("#birthDate").val();
            const gender = $("#gender").val();
            const username = $("#username").val();
            const email = $("#email").val();
            const password = $("#password").val();
            const contactNumber = $("#contactNumber").val();
            const address = $("#addressField").val();
            
            const payload = {
                "firstName" : firstName,
                "lastName" : lastName,
                "birthDate" : birthDate,
                "gender" : gender,
                "username" : username,
                "email" : email,
                "password" : password,
                "contactNumber" : contactNumber,
                "address" : address
            }
            
            prescoExecutePOST("api/UserAuthController/registerUser", payload, function (res) {
                if (res.status == "Success") {
                    $("#toastAddToCart").html(toast("Success", "You successfully registered an account."))
                    $('.toast').toast('show');
                }else{
                    $("#toastAddToCart").html(toast("Failed", "Email/Username already taken."))
                    $('.toast').toast('show');
                }
            })

        }
    })

    $("#btnLogin").unbind("click").on("click", function (e) { 
        var validate = true;
        
        $('.auth-form').each(function(e){
            if ($(this).val().length == 0) {
                $(this).addClass('border-danger');
                validate = false;
            }else{
                $(this).removeClass('border-danger');
            }
        });

        if(validate){
            const username = $("#loginUsername").val();
            const password = $("#loginPassword").val();

            const payload = {
                "username" : username,
                "password" : password
            }

            prescoExecutePOST("api/UserAuthController/verifyLogin",payload, function (response) { 
                if (response.status == "Success") {
                    Cookies.set('email', username, { expires: 10 })
                    if (response.type == "admin") {
                        window.location.replace(base_url + 'admin');
                    }else {
                        window.location.replace(base_url);
                    }
                }else {
                    $("#toastAddToCart").html(toast("Failed", "You are either not registered or ban."))
                    $('.toast').toast('show');
                }
            });
        }

    });

    $("#btnLogout").unbind("click").on("click", function (e) { 
        prescoExecuteGET("api/UserAuthController/verifyLogout", function (res) { 
            console.log(res);
            if ($(e.target).attr("user-type") == 'admin') {
                window.location.replace(base_url + 'login');
            }else{
                window.location.replace(base_url);
            }
        });
        Cookies.remove('email');
    });
    
});