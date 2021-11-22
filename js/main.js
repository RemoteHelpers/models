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
  
    function checkLS(){
        let selectedModels;
        if(!localStorage.getItem('selectedModels')){
            // console.log('pizda')
            selectedModels = []
        }
        else{
             selectedModels = JSON.parse(localStorage.getItem("selectedModels"));
        }
        
    }
    function isModelSelected(){
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels")) || [];
        let currentModelID = $("#js-selected").data("id");
        //  && $("#orderNow").data("id");
        let indexOfCurrentModelID = selectedModels.indexOf(currentModelID);
        return (indexOfCurrentModelID > -1);
    }
    function isSelectedEmpty(){
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels")) || [];
        return (selectedModels.length < 1);
    }
    function addModelToLS(){
        // console.log(1)
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels")) || [];
        let currentModelID = $("#js-selected").data("id");
        selectedModels.push(currentModelID);
        // console.log(currentModelID);
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
            // console.log(ex);
        }
    }
    if(!(isSelectedEmpty())){
        $("#js-order").addClass("visible");
    }
    if($("#js-selected").length>0){
        if(isModelSelected()){
            $("#js-selected").addClass("selected");
            // $("#js-selected").text('Added');
            $("#js-selected").text('Added');
        }
    }
    $(".starred-models").on("click", ".starred-model-rem", function(e){
        e.preventDefault();
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels"));
        // console.log($(this))
        let currentModelID = $(this).data("id");
        let indexOfCurrentModelID = selectedModels.indexOf(currentModelID);
        if($("#js-selected").length>0){
            if(isModelSelected() && ($("#js-selected").data("id")===currentModelID)){
                
                $("#js-selected").removeClass("selected");
                $("#js-selected").text("add to list");
                
            }
        }
        selectedModels.splice(indexOfCurrentModelID, 1);
        localStorage.setItem("selectedModels", JSON.stringify(selectedModels));
        $(this).parent().remove();
        if(isSelectedEmpty()){
            $(".shade-starred").fadeOut();
            $(".starred").fadeOut();
            $("#js-order").removeClass("visible");
        }
    });
    $( document ).ready(function() {
        checkLS()
        // let selectedModels = JSON.parse(localStorage.getItem("selectedModels"));
        // if(selectedModels.includes($("#js-selected").data("id"))){
        //     // console.log('this model is in local storage');
        //     $("#js-selected").text('Added')
        //     $("#js-selected").addClass('selected')
        // }
        // else{
        //     // console.log('isnt')
        // }
    });
    $("#js-selected").on("click", function(e){
        e.preventDefault();
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels"));
        // console.log(JSON.parse(localStorage.getItem("selectedModels")))
        // switch(selectedModels){
        //     case null:
        //         // console.log('null')
        //         addModelToLS(); 
        //         $(this).addClass("selected");
        //         $(this).text('Added')
        //         $("#js-order").addClass("visible");
        //         break;
        //     case []:
        //         // console.log('[]')
        //         addModelToLS(); 
        //         break;
        //     case selectedModels.includes($(this).data("id")):
        //         // console.log('test')
        //         break;
        //     default:
        //         // console.log('basa')
        //         addModelToLS(); 
        //         $(this).addClass("selected");
        //         $(this).text('Added')
        //         $("#js-order").addClass("visible");
        // }
        if(selectedModels == null){
            // console.log('null')
            addModelToLS();
            $(this).addClass("selected");
            $(this).text('Added')
            $("#js-order").addClass("visible");
            $.notifyBar({html: 'Added to the list',
            cssClass: 'success'});
        }
       else if(selectedModels.includes($(this).data("id"))){
            // console.log('already in — removing from ls')
            removeModelFromLS()
            // console.log(selectedModels)
            $(this).removeClass("selected");
            $(this).text('Add to list')
            $("#js-order").removeClass("visible");
        }
        else{
            addModelToLS();
            $.notifyBar({html: 'Added to the list',
            cssClass: 'success'});
            // console.log('adding to local')
            $(this).addClass("selected");
            $(this).text('Added')
            $("#js-order").addClass("visible");
            // // console.log(selectedModels);
            
        }
        
    });
    $("#orderNow").on("click", function(e){
        e.preventDefault();
        let selectedModels = JSON.parse(localStorage.getItem("selectedModels"));
        // console.log(selectedModels);

        if(selectedModels == null){
            // console.log('null')
            addModelToLS();
            $("html, body").animate({scrollTop: 0}, 400);
            $(".shade-starred").fadeIn();
            $(".starred").fadeIn();
            fillSelected();
            $("#js-order").addClass("visible");
        }
        else if(!selectedModels.includes($(this).data("id"))){
            addModelToLS();
            $("html, body").animate({scrollTop: 0}, 400);
            $(".shade-starred").fadeIn();
            $(".starred").fadeIn();
            fillSelected();
            $("#js-selected").addClass('selected')
            $("#js-selected").text('added')
            $("#js-order").addClass("visible");
        }
        else{
            $("html, body").animate({scrollTop: 0}, 400);
            $(".shade-starred").fadeIn();
            $(".starred").fadeIn();
            fillSelected();
            
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

    //Catalog quick info for touch devices
    $(".catalog-item a").one("touchstart", function (e) {
        e.preventDefault();
        $(this).addClass("visible");
    });

    //Filter
    if ($(".catalog-filter").length > 0) {
        function updateRangeLabel() {
            $(".catalog-filter .range-from").each(function () {
                $(this).parent().find(".label-from").text($(this).val() + '-');
            });
            $(".catalog-filter .range-to").each(function () {
                $(this).parent().find(".label-to").text($(this).val() + 'cm');
            });
        }

        let sliderFilterHeight = document.getElementById('filter-height');
        noUiSlider.create(sliderFilterHeight, {
            start: [120, 200],
            connect: true,
            step: 1,
            range: {
                'min': 120,
                'max': 200
            },
            format: {
                to: function (value) {
                    return value;
                },
                from: function (value) {
                    return Number(value);
                }
            }
        });
        let dataFilterHeight = [
            document.getElementById('filter-height-from'),
            document.getElementById('filter-height-to')
        ];
        sliderFilterHeight.noUiSlider.on('update', function (values, handle) {
            dataFilterHeight[handle].value = values[handle];
            updateRangeLabel();
        });

        let sliderFilterBust = document.getElementById('filter-bust');
        noUiSlider.create(sliderFilterBust, {
            start: [60, 120],
            connect: true,
            step: 1,
            range: {
                'min': 60,
                'max': 120
            },
            format: {
                to: function (value) {
                    return value;
                },
                from: function (value) {
                    return Number(value);
                }
            }
        });
        let dataFilterBust = [
            document.getElementById('filter-bust-from'),
            document.getElementById('filter-bust-to')
        ];
        sliderFilterBust.noUiSlider.on('update', function (values, handle) {
            dataFilterBust[handle].value = values[handle];
            updateRangeLabel();
        });

        let sliderFilterWaist = document.getElementById('filter-waist');
        noUiSlider.create(sliderFilterWaist, {
            start: [40, 80],
            connect: true,
            step: 1,
            range: {
                'min': 40,
                'max': 80
            },
            format: {
                to: function (value) {
                    return value;
                },
                from: function (value) {
                    return Number(value);
                }
            }
        });
        let dataFilterWaist = [
            document.getElementById('filter-waist-from'),
            document.getElementById('filter-waist-to')
        ];
        sliderFilterWaist.noUiSlider.on('update', function (values, handle) {
            dataFilterWaist[handle].value = values[handle];
            updateRangeLabel();
        });

        let sliderFilterHips = document.getElementById('filter-hips');
        noUiSlider.create(sliderFilterHips, {
            start: [60, 120],
            connect: true,
            step: 1,
            range: {
                'min': 60,
                'max': 120
            },
            format: {
                to: function (value) {
                    return value;
                },
                from: function (value) {
                    return Number(value);
                }
            }
        });
        let dataFilterHips = [
            document.getElementById('filter-hips-from'),
            document.getElementById('filter-hips-to')
        ];
        sliderFilterHips.noUiSlider.on('update', function (values, handle) {
            dataFilterHips[handle].value = values[handle];
            updateRangeLabel();
        });

        $(".filter-cat input").on("change", function () {
            if ($(this).prop("checked")) {
                $(this).parent().addClass("selected");
            } else {
                $(this).parent().removeClass("selected");
            }
        });
		
		$("#catalog-filter-form").on("reset", function() {
            $(".filter-cat input").each(function() {
                $(this).parent().removeClass("selected");
            });
            sliderFilterHeight.noUiSlider.reset();
            sliderFilterBust.noUiSlider.reset();
            sliderFilterWaist.noUiSlider.reset();
            sliderFilterHips.noUiSlider.reset();
        });
    }

    //Model slider
    if ($(".madel-slide").length > 0) {
        $(".madel-slide").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            // asNavFor: '.madel-slide-nav'
        });
        $(".madel-slide-nav").slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            asNavFor: '.madel-slide',
            dots: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1000,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

    //Similar models title for touch devices
    $(".models-similar-item a").one("touchstart", function (e) {
        e.preventDefault();
        $(this).addClass("visible");
    });

    //Order
    $("#starred-form").on("submit", function (e) {
        e.preventDefault();
        //Wait demo
        $("#starred-wait").fadeIn("normal", function () {
            setTimeout(function () {
                $("#starred-wait").fadeOut();
                $("#starred-thanks").fadeIn();
            }, 2000);
        });
    });
    $("#starred-thanks").on("click", function () {
        $(this).fadeOut();
    });

    //Contact
    $("#home-form").on("submit", async function (e) {
        // e.preventDefault();

        $("#home-wait").fadeIn();


        let name = $('#home-name').val();
        let phone = $('#home-phone').val();
        let mail = $('#home-mail').val();
        let about = $('#home-about').val();

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
                $("#home-wait").fadeOut();
                $("#home-thanks").fadeIn();//show thanks

                $('#home-form')[0].reset();
            }

        }//try
        catch( ex ){

            // console.log('EX: ' , ex);

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

//filter
    $("#catalog-filter-form").on("submit", async function (e) {
        e.preventDefault();

        let formData = new FormData();

        formData.append('action', 'getModelsList');
        try {
            let response = await $.ajax({
                'url': '/wp-admin/admin-ajax.php',
                'type': 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
            });

            if (+response.code === 200) {

                let heightFrom = $('#filter-height-from').val();
                let heightTo = $('#filter-height-to').val();

                let bustFrom = $('#filter-bust-from').val();
                let bustTo = $('#filter-bust-to').val();

                let waistFrom = $('#filter-waist-from').val();
                let waistTo = $('#filter-waist-to').val();

                let hipsFrom = $('#filter-hips-from').val();
                let hipsTo = $('#filter-hips-to').val();

                let hairs = $('#filter-hair').val();
                let eyes = $('#filter-eyes').val();

                let idsCat = [].map.call( $('.filter-cat input:checked') , ( opt )=>{ return $(opt).data('idcat') } );


                let models = response.models;
                
                var filtered = models.filter(model => {
                    if(+model.modelHeight < heightFrom || +model.modelHeight > heightTo) { // checking just the category, but you can check if any of more fields contains the conditions
                        return false;
                    }
                    if(+model.modelBust < bustFrom || +model.modelBust > bustTo) {
                        return false;
                    }
                    if(+model.modelWaist < waistFrom || +model.modelWaist > waistTo) {
                        return false;
                    }
                    if(+model.modelHips < hipsFrom || +model.modelHips > hipsTo) {
                        return false;
                    }
                    if(hairs && model.modelHair != hairs) {
                        return false;
                    }
                    if(eyes && model.modelEye != eyes) {
                        return false;
                    }

                    if(idsCat.length>0){
                        return model.modelCat.some(cat=>idsCat.indexOf(cat)>=0 )
                    }

                    return true;
                });

                $('.catalog-item').remove();
                $('.pagination').fadeOut();

                filtered.forEach(model=>{
                    $('.catalog-list').append(`
                    <li class="catalog-item">
                <a href="${model.link}">
                    <div>
                        <img src="${model.modelImage}" alt="${model.modelTitle}">
                        <ul>
                            <li><dl><dt>Height:</dt><dd>${model.modelHeight}cm</dd></dl></li>
                            <li><dl><dt>Bust:</dt><dd>${model.modelBust}cm</dd></dl></li>
                            <li><dl><dt>Waist:</dt><dd>${model.modelWaist}cm</dd></dl></li>
                            <li><dl><dt>Hips:</dt><dd>${model.modelHips}cm</dd></dl></li>
                            <li><dl><dt>Hair:</dt><dd>${model.modelHair}</dd></dl></li>
                            <li><dl><dt>Eyes:</dt><dd>${model.modelEye}</dd></dl></li>
                            <li><dl><dt>Age:</dt><dd>${model.modelAge}</dd></dl></li>
                        </ul>
                    </div>
                    <p>${model.modelTitle} <span>ID:${model.modelID}</span></p>
                </a>
            </li>
                    `);
                });
                $(".shade-filter").fadeOut();
                $(".catalog-filter").fadeOut();
            }//if
            else {

            }//else

        }//try
        catch (ex) {
            // console.log(ex);
        }//catch

    });

    //Load more models
    let numberposts = 20;
    let offset = 20;

    $("#more-catalog").on("click", async function (e) {
        e.preventDefault();

        $(this).addClass('loading');

        let formData = new FormData();

        formData.append('action', 'getModelsListMore');
        formData.append('numberposts', numberposts);
        formData.append('offset', offset);
        try {
            let response = await $.ajax({
                'url': '/wp-admin/admin-ajax.php',
                'type': 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
            });

            if (+response.code === 200) {
                let models = response.models;

                models.forEach(model=>{
                    $('.catalog-list').append(`
                    <li class="catalog-item">
                <a href="${model.link}">
                    <div>
                        <img src="${model.modelImage}" alt="${model.modelTitle}">
                        <ul>
                            <li><dl><dt>Height:</dt><dd>${model.modelHeight}cm</dd></dl></li>
                            <li><dl><dt>Bust:</dt><dd>${model.modelBust}cm</dd></dl></li>
                            <li><dl><dt>Waist:</dt><dd>${model.modelWaist}cm</dd></dl></li>
                            <li><dl><dt>Hips:</dt><dd>${model.modelHips}cm</dd></dl></li>
                            <li><dl><dt>Hair:</dt><dd>${model.modelHair}</dd></dl></li>
                            <li><dl><dt>Eyes:</dt><dd>${model.modelEye}</dd></dl></li>
                            <li><dl><dt>Age:</dt><dd>${model.modelAge}</dd></dl></li>
                        </ul>
                    </div>
                    <p>${model.modelTitle} <span>ID:${model.modelID}</span></p>
                </a>
            </li>
                    `);
                });

                $(this).removeClass('loading');
                if(models.length < numberposts){
                    $('.pagination').fadeOut();
                }
                offset+=numberposts;
            }//if
            else {

            }//else

        }//try
        catch (ex) {
            // console.log(ex);
        }//catch

    });

    //Load more news
    let numbernews = 10;
    let offsetnews = 10;

    $("#more-news").on("click", async function (e) {
        e.preventDefault();

        $(this).addClass('loading');

        let formData = new FormData();

        formData.append('action', 'getNewsListMore');
        formData.append('numbernews', numbernews);
        formData.append('offsetnews', offsetnews);

        try {
            let response = await $.ajax({
                'url': '/wp-admin/admin-ajax.php',
                'type': 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
            });

            if (+response.code === 200) {
                let news = response.news;

                news.forEach(newsi=>{
                    $('.content-txt').append(`
        <article class="news-item">
            <figure class="post-thumbnail">
                <a href="${newsi.newsLink}">
                    <img src="${newsi.newsImage}" alt="${newsi.newsTitle}">
                </a>
            </figure>
            <div class="post-content">
                <h2 class="entry-title"><a href="${newsi.newsLink}">${newsi.newsTitle}</a></h2>
                <time class="entry-date">${newsi.newsDate}</time>
                <div class="entry-content">
                    <p>${newsi.newsExcerpt}</p>
                </div>
                <div class="entry-link">
                    <a href="${newsi.newsLink}">More</a>
                </div>
            </div>
        </article>
                    `);
                });

                $(this).removeClass('loading');
                if(news.length < numbernews){
                    $('.pagination').fadeOut();
                }
                offsetnews+=numbernews;
            }//if
            else {

            }//else

        }//try
        catch (ex) {
            // console.log(ex);
        }//catch

    });
});
