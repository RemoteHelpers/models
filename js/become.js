jQuery(document).ready(function($) {

    //Ranges
    $(".become-list input[type=range]").on("change mousemove", function() {
        $(this).parent().find("label span").text($(this).val()+'cm');
    });

    //Categories
    $(".become-cat input").on("change", function() {
        if($(this).prop("checked")){
            $(this).parent().addClass("selected");
        }
        else{
            $(this).parent().removeClass("selected");
        }
    });

    //Rights
    function showRights(){
        $("html, body").animate({scrollTop: 0}, 400);
        $(".shade-rights").fadeIn();
        $(".become-rights").fadeIn();
    }
    function closeRights(){
        $(".shade-rights").fadeOut();
        $(".become-rights").fadeOut();
    }
    function isRightsAccepted(){
        return $("#become-agree").prop("checked");
    }
    $(".shade-rights").on("click", function(){
        closeRights();
    });
    $("#rights-accept").on("click", function(e){
        e.preventDefault();
        $("#become-agree").prop('checked', true);
        closeRights();
    });
    $("#become-agree").on("click", function(e){
        e.preventDefault();
        showRights();
    });
    $("#become-submit-3").on("click", function(){
        if( !( isRightsAccepted() ) ){
            showRights();
        }
    });

    let formData = new FormData();

    //Submit form and steps
    $("#become-form-1").on("submit", function (e){
        e.preventDefault();
        let fname = $('#become-fname').val();
        let lname = $('#become-lname').val();
        let sname = $('#become-sname').val();
        let age = $('#become-age').val();
        let phone = $('#become-phone').val();
        let mail = $('#become-mail').val();
		let city = $('#become-city').val();

        formData.append('fname' , fname);
        formData.append('lname' , lname);
        formData.append('sname' , sname);
        formData.append('age' , age);
        formData.append('phone' , phone);
        formData.append('mail' , mail);
		formData.append('city' , city);

        let date = new Date();

         let day = date.getDate();
         let month = date.getMonth();
         let year = date.getFullYear();

         if(day<10){
             day=`0${day}`
         }
         if(month+1<10){
             month=`0${month+1}`
         }

         let dates = document.querySelectorAll('#date-relise');

        dates.forEach(item=>{
             item.textContent = `${day}/${month}/${year} `;
         })

        let names = document.querySelectorAll('#name-relise');

        names.forEach(item=>{
            item.textContent = `${fname} `;
        });

        let signatures = document.querySelectorAll('#signature-relise');

        signatures.forEach(item=>{
            item.textContent = `${fname} ${lname} `;
        });

        let fios = document.querySelectorAll('#fio-relise');

        fios.forEach(item=>{
            item.textContent = `${lname} ${fname} `;
        });

        let phones = document.querySelectorAll('#phone-relise');

        phones.forEach(item=>{
            item.textContent = `${phone} `;
        });

        let emails = document.querySelectorAll('#email-relise');

        emails.forEach(item=>{
            item.textContent = `${mail} `;
        });

        $("#become-pu-1").slideUp();
        $("#become-pu-2").slideDown();
    });
    $("#become-form-2").on("submit", function (e){
        e.preventDefault();

        let height = $('#become-height').val();
        let bust = $('#become-bust').val();
        let waist = $('#become-waist').val();
        let hips = $('#become-hips').val();
        let hair = $('#become-hair').val();
        let eyes = $('#become-eyes').val();

        let idsCat = [].map.call( $('.become-cat input:checked') , ( opt )=>{ return $(opt).data('idcat') } );

        formData.append('height' , height);
        formData.append('bust' , bust);
        formData.append('waist' , waist);
        formData.append('hips' , hips);
        formData.append('hair' , hair);
        formData.append('eyes' , eyes);
        formData.append('idsCat' , JSON.stringify(idsCat));

        $("#become-pu-2").slideUp();
        $("#become-pu-3").slideDown();
    });

    $('#imges').on('click', 'a#deleteImage',function (e) {
        e.preventDefault();
        let index = $(this).data('id-im');
        console.log('data-id-im', index);

        delete window.filesArray[index];
        $(this).parent().remove();
        

    });

    $("#become-form-3").on("submit", async function (e){
        e.preventDefault();

        $("#become-wait").fadeIn();

        let insta = $('#become-insta').val();

        let about = $('#become-about').val();
        formData.append('about' , about);

        for (var key in filesArray) {

            formData.append('files[]' , filesArray[key]);
        }

        let filesPassport = $('#fileUploadPassport').prop('files');

        if(filesPassport.length !== 0){

                formData.append('filesPassport' , filesPassport[0]);

        }//if

        formData.append('action' , 'addModel');
        formData.append('insta' , insta);


        try{

            let response = await $.ajax({
                'url': '/wp-admin/admin-ajax.php',
                'type': 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
            });

console.log('response',response);

            
            if(response.code==200 || response.code == 401){
                filesArray={};
                $("#become-wait").fadeOut();
                $("#become-pu-3").slideUp();
                $("#become-pu-4").slideDown();
            }

        }//try
        catch( ex ){

            console.log('EX: ' , ex);

        }//catch


    });

});
