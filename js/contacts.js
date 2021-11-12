jQuery(document).ready(function ($) {
     //Contact
    $("#contact-form").on("submit", async function (e) {
        // e.preventDefault();

        $("#contact-wait").fadeIn();


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
            console.log("1")
            let response = await $.ajax({
                'url': '/wp-admin/admin-ajax.php',
                'type': 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
            });

            if(response.code==200 || response.code == 401){
                console.log("2")
                $("#contact-wait").fadeOut();
                $("#contact-thanks").fadeIn();//show thanks
                console.log("3")
                $('#contact-form')[0].reset();
            }

        }//try
        catch( ex ){
            console.log("4")
            console.log('EX: ' , ex);

        }//catch

        //Wait demo
        $("#contact-wait").fadeIn("normal", function () { //show wait
            setTimeout(function () {
                $("#contact-wait").fadeOut();
                $("#contact-thanks").fadeIn();//show thanks
        
        
            }, 2000);
        });
    });
    $("#contact-thanks").on("click", function () {
        $(this).fadeOut();
    });

});