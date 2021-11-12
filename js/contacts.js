jQuery(document).ready(function ($) {
   //Conditions
    let homeScrollTop = 0;
    $("#home-agree-link").on("click", function(e){
        e.preventDefault();
        homeScrollTop = $(document).scrollTop();
        $("html, body").animate({scrollTop: 0}, 400);
        $(".shade-conditions").fadeIn();
        $(".home-conditions").fadeIn();
    });
    $(".shade-conditions").on("click", function(){
        $(".shade-conditions").fadeOut();
        $(".home-conditions").fadeOut();
        $("html, body").animate({scrollTop: homeScrollTop}, 400);
    });

    //Mobile menu
    $(".head-nav-tr").on("click", function (e) {
        e.preventDefault();
        $(".shade-menu").fadeIn();
        $(".head-nav").fadeIn("normal", function () {
            $(this).addClass("active").removeAttr("style");
        });
        $(".head-nav-tr").addClass("active");
        $(".head-home").addClass("active");
    });
    $(".shade-menu").on("click", function () {
        $(".shade-menu").fadeOut();
        $(".head-nav").fadeOut("normal", function () {
            $(this).removeClass("active").removeAttr("style");
        });
        $(".head-nav-tr").removeClass("active");
        $(".head-home").removeClass("active");
    });

    //Float buttons
    //Filter
    if ($(".catalog-filter").length > 0) {
        $("#js-filter").addClass("visible");
        $("#js-filter").on("click", function (e) {
            e.preventDefault();
            $("html, body").animate({scrollTop: 0}, 400);
            $(".shade-filter").fadeIn();
            $(".catalog-filter").fadeIn();
        });
        $(".shade-filter").on("click", function () {
            $(".shade-filter").fadeOut();
            $(".catalog-filter").fadeOut();
        });
    }
});
    //Contact
    $("#home-form").on("submit", async function (e) {
        // e.preventDefault();

        $("#home-wait").fadeIn();


        let name = $('#contact-name').val();
        let phone = $('#contact-phone').val();
        let mail = $('#contact-mail').val();
        let about = $('#contact-about').val();

        let formData = new FormData();

        formData.append('name' , name);
        formData.append('phone' , phone);
        formData.append('email' , mail);
        formData.append('message' , about);

        formData.append('action' , 'sendContactUs');
        try{

            let response = await $.ajax({
                'url': '/wp-admin/admin-ajax.php',
                'type': 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
            });

            if(response.code==200 || response.code == 401){
                $("#contact-wait").fadeOut();
                $("#contact-thanks").fadeIn();//show thanks

                $('#home-form')[0].reset();
            }

        }//try
        catch( ex ){

            console.log('EX: ' , ex);

        }//catch

        // //Wait demo
        // $("#home-wait").fadeIn("normal", function () { //show wait
        //     setTimeout(function () {
        //         $("#home-wait").fadeOut();
        //         $("#home-thanks").fadeIn();//show thanks
        //
        //
        //     }, 2000);
        // });
    });
    $("#home-thanks").on("click", function () {
        $(this).fadeOut();
    });
