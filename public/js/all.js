$(document).ready(function () { 
    var navigation = $("#presco-navigation");

    navigation.unbind("click").on("click", function (e) { 
       const nav = $(e.target);
       
       if (nav.is(":checked")) {
            setTimeout(function () { 
                $(".navigation-container").removeClass("col-lg-2").addClass("d-none");
                $(".main-content").removeClass("col-lg-10").addClass("col-lg-12");
            },500);
       }else {
            $(".navigation-container").removeClass("d-none").addClass("col-lg-2");
            $(".main-content").removeClass("col-lg-12").addClass("col-lg-10");
       }
    })

});