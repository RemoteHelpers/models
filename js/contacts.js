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