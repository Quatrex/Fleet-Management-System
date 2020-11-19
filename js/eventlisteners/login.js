$(document).ready(function() {

    $('#username-input').keyup(function() {
        if (document.forms['vform']['username'].value.trim().length >= 3) {
            document.querySelector('#name-error').innerHTML = null;
        } else {
            document.querySelector('#name-error').innerHTML = "Username must be at least 3 characters";
            document.querySelector('#username-input').className = 'form-control';
        }
    });
    $('#password-input').keyup(function() {
        document.querySelector('#password-error').innerHTML = null;
        document.querySelector('#password-input').className = 'form-control';
    });

    $("body").on("input propertychange", ".floating-label-form-group", function(e) {
        $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
    }).on("focus", ".floating-label-form-group", function() {
        $(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function() {
        $(this).removeClass("floating-label-form-group-with-focus");
    });

    $("body").on('click', '.toggle-password', function() {
        $('.toggle-password').toggleClass("fa-eye fa-eye-slash");
        var input = $("#password-input");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
});