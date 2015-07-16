/** * Created by yossi shaish on 03/07/2015. */
$(function() {

    $('.dropzone').html5imageupload();

    $("#Country").on("change", function(){
        getCities();
    });

    $("#editProfileForm").validate({
        submitHandler: function(form) {
            console.log(form);
            var $btn = $(form).find("input[type='submit']");
            $btn.button('loading');
            form.submit();
        }
    });

    getCities();

    $.getJSON("/assets/js/json/shops.json", function(data){
        $('#BestShop').autocomplete({
            lookup: data
        });
    });

});

function getCities() {
    var Country = $("#Country").find(":selected").text();
    $.getJSON("/assets/js/json/cities.json", function(data){
        var cities = data[Country];
        $('#City').autocomplete({
            lookup: cities
        });
    });
}


