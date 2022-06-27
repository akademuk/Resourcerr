
var onloadReCaptchaInvisible = function() {
    window.idCaptcha1 = grecaptcha.render('recaptcha1', {
        "sitekey":pubRecaptchaKey,
        // "callback": "onSubmitReCaptcha",
        "size":"invisible",
        "badge":"bottomright" // bottomright, bottomleft, inline
    });
    window.idCaptcha1 = grecaptcha.render('recaptcha2', {
        "sitekey":pubRecaptchaKey,
        // "callback": "onSubmitReCaptcha",
        "size":"invisible",
        "badge":"bottomright" // bottomright, bottomleft, inline
    });
};