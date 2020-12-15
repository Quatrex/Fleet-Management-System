$(document).ready(function () {
    const logInValidator = new LogInValidator();

    $('#email-input').keyup(function () {
        if (!logInValidator.validateEmail(document.forms['vform']['email'].value.trim())) {
            document.querySelector('#name-error').innerHTML = logInValidator.getEmailError();
        } else {
            document.querySelector('#name-error').innerHTML = null;
            document.querySelector('#email-input').className = 'form-control';
        }
    });
    $('#password-input').keyup(function () {
        if (!logInValidator.validatePassword(document.forms['vform']['password'].value.trim())) {
            document.querySelector('#password-error').innerHTML = logInValidator.getPasswordError();
        } else {
            document.querySelector('#password-error').innerHTML = null;
            document.querySelector('#password-input').className = 'form-control';
        }
    });

    $("body").on("input propertychange", ".floating-label-form-group", function (e) {
        $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
    }).on("focus", ".floating-label-form-group", function () {
        $(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function () {
        $(this).removeClass("floating-label-form-group-with-focus");
    });

    $("body").on('click', '.toggle-password', function () {
        $('.toggle-password').toggleClass("fa-eye fa-eye-slash");
        var input = $("#password-input");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
});