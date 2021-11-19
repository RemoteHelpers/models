jQuery(document).ready(function ($) {
    $("#contact-form").on("submit", function (e) {
        e.preventDefault();
        console.log('work form');

                //contact page
        let c_name = $("#contact-name").val();
        let c_mail = $("#contact-mail").val();
        let c_phon = $("#contact-phone").val();
        let c_abot = $("#contact-about").val();

        let file_data= {c_name, c_mail, c_phon, c_abot};
        let file_pas ='/wp-content/plugins/mailer-plugin/mail-sending.php';

        $.ajax({
            'url':      file_pas,
            'data':     file_data,
            'type':     "post",
            'method':   'post',
            'dataType': 'json',
        }).done(function(mail){
           console.log(mail.responce);
        });

    });
});
