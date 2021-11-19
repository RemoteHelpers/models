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

$(document).ready(function(){
     
    // client id of the project

    var clientId = "307783078919-0hoh2642qf8iu32kf4uqr3o08r0qb5hc.apps.googleusercontent.com";

    // redirect_uri of the project

    var redirect_uri = "http://localhost/GoogleDriveUpload/upload.html";

    // scope of the project

    var scope = "https://www.googleapis.com/auth/drive";

    // the url to which the user is redirected to

    var url = "";


    // this is event click listener for the button

    $("#login").click(function(){

       // this is the method which will be invoked it takes four parameters

       signIn(clientId,redirect_uri,scope,url);

    });

    function signIn(clientId,redirect_uri,scope,url){
     
       // the actual url to which the user is redirected to 

       url = "https://accounts.google.com/o/oauth2/v2/auth?redirect_uri="+redirect_uri
       +"&prompt=consent&response_type=code&client_id="+clientId+"&scope="+scope
       +"&access_type=offline";

       // this line makes the user redirected to the url

       window.location = url;




    }



});