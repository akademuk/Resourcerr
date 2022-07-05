// disabling form submissions if there are invalid fields and highlight input validation and submitAjaxForm
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {

                    event.preventDefault();
                    event.stopPropagation();
                    let formParams = new FormEventParams

                    //captcha
                    let idCaptcha = $("[name='captcha']",$(form)).val()

                    grecaptcha.execute(window[idCaptcha]) // todo: check window[idCaptcha]
                        .then(function (token) {
                            //do your ajax submition here
                            submitAjaxForm(form, formParams.callbackSuccess, formParams.callbackFail, token);
                        });

                    return true;
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();


class FormEventParams{
     callbackSuccess(form){
         //show modal
         var modal1 = document.getElementById("myModal");
         modal1.style.display = "block";
         $(form)[0].reset();
         closeModal()
    }

    callbackFail(){
         // console.log('fail')
    }
}


function submitAjaxForm(form, callbackSuccess, callbackFail, gToken) {
    $(document).ready(function () {
        let action = form.getAttribute("action")
        let formData = $(form).serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
        try{
        formData['g-recaptcha-response'] = gToken;

        $("body").removeClass("loaded");
        $('#loader').fadeIn();

        $.ajax({
            type: "POST",
            url: action,
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            callbackSuccess(form)
            $("body").addClass("loaded"); //loader
            $('#loader').fadeOut(); //end loader
        })
        //     .error(function() {
        //     callbackFail() //todo: check
        // })
        }
        catch (e){
            alert(e);
        }


    })
}