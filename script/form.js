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

                    //do your ajax submition here
                    let callbackResult = new RequirementsOfTheProject
                    submitAjaxForm(form, callbackResult.callbackSuccess, callbackResult.callbackFail);
                    event.preventDefault();
                    event.stopPropagation();

                    return true;
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();


class RequirementsOfTheProject{
     callbackSuccess(){
         //show modal
         var modal1 = document.getElementById("myModal");
         modal1.style.display = "block";
    }

    callbackFail(){
         // console.log('fail')
    }
}


function submitAjaxForm(form, callbackSuccess, callbackFail) {
    $(document).ready(function () {
        let action = form.getAttribute("action")
        let formData = $(form).serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
        try{
            $.ajax({
                type: "POST",
                url: action,
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                callbackSuccess()
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