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
    //Order
    function isModelSelected(){
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels")) || [];
        let currentModelID = $("#js-selected").data("id");
        let indexOfCurrentModelID = selectedModels.indexOf(currentModelID);
        return (indexOfCurrentModelID > -1);
    }
    function isSelectedEpty(){
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels")) || [];
        return (selectedModels.length < 1);
    }
    function addModelToLS(){
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels")) || [];
        let currentModelID = $("#js-selected").data("id");
        selectedModels.push(currentModelID);
        localStorage.setItem("selectedModels", JSON.stringify(selectedModels));
    }
    function removeModelFromLS(){
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels"));
        let currentModelID = $("#js-selected").data("id");
        let indexOfCurrentModelID = selectedModels.indexOf(currentModelID);
        selectedModels.splice(indexOfCurrentModelID, 1);
        localStorage.setItem("selectedModels", JSON.stringify(selectedModels));
    }
    async function fillSelected(){
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels")) || [];
        let formData = new FormData();
        formData.append('action', 'getModelsListFavorites');
        try{
            let response = await $.ajax({
                'url': '/wp-admin/admin-ajax.php',
                'type': 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
            });
            if (+response.code === 200){
                let models = response.models;
                let filtered = models.filter(model=>{
                    return (selectedModels.indexOf(+model.modelID) > -1);
                });
                $(".starred-model").remove();
                filtered.forEach(model=>{
                    $(".starred-models").append(`
                <li class="starred-model">
                    <input class="starred-model-id" name="starred-model-id" type="hidden" value="${model.modelID}">
                    <a class="starred-model-rem" data-id="${model.modelID}" href="#"></a>
                    <a class="starred-model-link" href="${model.modelLink}">
                        <img class="starred-model-img" src="${model.modelImage}" alt="">
                        <div class="starred-model-tit">${model.modelTitle}</div>
                        <div class="starred-model-tit">ID: ${model.modelID}</div>
                        <div class="starred-model-txt">View profile</div>
                    </a>
                </li>
                    `);
                });
            }
        }
        catch (ex){
            console.log(ex);
        }
    }
    if(!(isSelectedEpty())){
        $("#js-order").addClass("visible");
    }
    if($("#js-selected").length>0){
        if(isModelSelected()){
            $("#js-selected").addClass("selected");
        }
    }
    $(".starred-models").on("click", ".starred-model-rem", function(e){
        e.preventDefault();
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels"));
        let currentModelID = $(this).data("id");
        let indexOfCurrentModelID = selectedModels.indexOf(currentModelID);
        if($("#js-selected").length>0){
            if(isModelSelected() && ($("#js-selected").data("id")===currentModelID)){
                $("#js-selected").removeClass("selected");
            }
        }
        selectedModels.splice(indexOfCurrentModelID, 1);
        localStorage.setItem("selectedModels", JSON.stringify(selectedModels));
        $(this).parent().remove();
        if(isSelectedEpty()){
            $(".shade-starred").fadeOut();
            $(".starred").fadeOut();
            $("#js-order").removeClass("visible");
        }
    });
    $("#js-selected").on("click", function(e){
        e.preventDefault();
        if($(this).hasClass("selected")){
            $(this).removeClass("selected");
            removeModelFromLS();
            if(isSelectedEpty()){
                $("#js-order").removeClass("visible");
            }
        }
        else{
            $(this).addClass("selected");
            if(isSelectedEpty()){
                $("#js-order").addClass("visible");
            }
            addModelToLS();
        }
    });
    $("#js-order").on("click", function(e){
        e.preventDefault();
        $("html, body").animate({scrollTop: 0}, 400);
        $(".shade-starred").fadeIn();
        $(".starred").fadeIn();
        fillSelected();
    });
    $(".shade-starred").on("click", function(){
        $(".shade-starred").fadeOut();
        $(".starred").fadeOut();
    });
    //Up
    function upButtonVisibility() {
        let requiredTopOffset = 100;
        let currentTopOffset = window.pageYOffset;
        if (currentTopOffset > requiredTopOffset) {
            $("#js-top").addClass("visible");
        } else {
            $("#js-top").removeClass("visible");
        }
    }

    upButtonVisibility();
    $(window).scroll(upButtonVisibility);
    $("#js-top").on("click", function (e) {
        e.preventDefault();
        $("html, body").animate({scrollTop: 0}, 400);
    });
});