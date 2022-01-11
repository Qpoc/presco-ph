$(document).ready(function () { 

    $("#birthDate").datepicker({
        format: 'yyyy/mm/dd',
    });

    $("#btnRegister").unbind("click").on("click", function (e) { 
        const fullName = $("#fullName").val();
        const birthDate = $("#birthDate").val();
        const gender = $("#gender").val();
        const username = $("#username").val();
        const email = $("#email").val();
        const password = $("#password").val();
        
        const payload = {
            "fullName" : fullName,
            "birthDate" : birthDate,
            "gender" : gender,
            "username" : username,
            "email" : email,
            "password" : password,
        }
        
        prescoExecutePOST("api/UserAuthController/registerUser", payload, function (response) {
            console.log(response);
        })

    });

    $("#btnLogin").unbind("click").on("click", function (e) { 
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
            }
        });

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