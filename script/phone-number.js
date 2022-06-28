var input = document.querySelector(".phone");
intlTelInput(input, {
  initialCountry: "auto",
  nationalMode: false,
  geoIpLookup: function (success, failure) {
    $.get("https://ipinfo.io", function () { }, "jsonp").always(function (resp) {
      var countryCode = (resp && resp.country) ? resp.country : "us";
      success(countryCode);
    });
  },
});