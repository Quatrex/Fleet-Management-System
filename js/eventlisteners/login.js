$(document).ready(function () {
    $('#login-button').on('click', function () {
        username = document.forms['vform']['username'];
        password = document.forms['vform']['password'];
        validator = new LogInValidator(username.value.trim(), password.value.trim());
        passwordValidation = validator.validatePassword();
        userValidation = validator.validateUserName();
        name_error = document.getElementById('name-error');
        password_error = document.getElementById('password-error');
        if (userValidation != true) {
            username.style.boxShadow = "0 0 10px red";
            name_error.textContent = userValidation;
            username.focus();
        }
        if (passwordValidation != true) {
            password.style.boxShadow = "0 0 10px red";
            password_error.textContent = passwordValidation;
            password.focus();
        }
        if (!((userValidation != true) || (passwordValidation != true))) {
            $.ajax({
                url: "../func/authenticate.php",
                type: 'POST',
                data: {
                    username: username.value.trim(),
                    password: password.value.trim()
                },
                success: function (response) {
                    console.log(response);
                    if (response.startsWith("../")) {
                        window.location = response;
                    } else if (response.endsWith("username!")) {
                        username.style.boxShadow = "0 0 10px red";
                        name_error.textContent = response;
                        username.focus();
                    }
                    else if (response.endsWith("password!")) {
                        password.style.boxShadow = "0 0 10px red";
                        password_error.textContent = response;
                        password.focus();
                    }
                }
            });
        }
        return false;
    });
    $('#username-input').keyup(function () {
        $('#name-error').innerHTML='';
    });
    $('#password-input').keyup(function () {
        $('#password-error').innerHTML='';
    });
});