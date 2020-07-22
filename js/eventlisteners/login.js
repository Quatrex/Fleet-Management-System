$(document).ready(function () {
    $('#login-button').on('click', function () {
        // username = document.forms['vform']['username'];
        // password = document.forms['vform']['password'];
        // validator = new LogInValidator(username.value.trim(), password.value.trim());
        // passwordValidation = validator.validatePassword();
        // userValidation = validator.validateUserName();
        // name_error = document.getElementById('name-error');
        // password_error = document.getElementById('password-error');
        // if (userValidation != true) {
        //     document.querySelector('#username-input').className += ' is-invalid';
        //     name_error.textContent = userValidation;
        //     username.focus();
        //     return false;
        // }
        // if (passwordValidation != true) {
        //     document.querySelector('#password-input').className += ' is-invalid';
        //     password_error.textContent = passwordValidation;
        //     return false;
        //     // password.focus();
        // }
        // if (!((userValidation != true) || (passwordValidation != true))) {
        //     $.ajax({
        //         url: "../func/authenticate.php",
        //         type: 'POST',
        //         data: {
        //             username: username.value.trim(),
        //             password: password.value.trim()
        //         },
        //         success: function (response) {
        //             if (response.startsWith("../")) {
        //                 console.log(response);
        //                 window.location = response;
        //             } else if (response.endsWith("username!")) {
        //                 document.querySelector('#username-input').className+=' is-invalid';
        //                 name_error.textContent = response;
        //                 document.querySelector('#password-input').className='form-control';
        //                 username.focus();
        //             }
        //             else if (response.endsWith("password!")) {
        //                 document.querySelector('#password-input').className+=' is-invalid';
        //                 password_error.textContent = response;
        //                 document.querySelector('#username-input').className='form-control';
        //                 password.focus();
        //             }
        //         }
        //     });
        // }
        // return false;
    });
    $('#username-input').keyup(function () {
        if (document.forms['vform']['username'].value.trim().length >= 3) {
            document.querySelector('#name-error').innerHTML = null;
        }
        else {
            document.querySelector('#name-error').innerHTML = "Username must be at least 3 characters";
            document.querySelector('#username-input').className = 'form-control';
        }
    });
    $('#password-input').keyup(function () {
        document.querySelector('#password-error').innerHTML = null;
        document.querySelector('#password-input').className = 'form-control';
    });
});



// validator = new LogInValidator();
// username = document.forms['vform']['username'].value.trim();
// password = document.forms['vform']['password'].value.trim();

// $('#username-input').keyup(function (event) {
//     username = document.forms['vform']['username'].value.trim();
//     console.log(username + password);
//     if (validator.validateUsername(username)) {
//         document.querySelector('#username-input').className = 'form-control';
//         if (event.keyCode === 13 && validator.validatePassword(password)) {
//             console.log(1);
//             // document.getElementById("login-button").click();
//         }
//     }
//     else {
//         document.querySelector('#username-input').className = 'form-control is-invalid';
//     }
//     document.querySelector('#name-error').innerHTML = validator.getUsernameError();
// });
// $('#password-input').keyup(function (event) {
//     password = document.forms['vform']['password'].value.trim();
//     console.log(username + password);
//     if (validator.validatePassword(password)) {
//         document.querySelector('#password-input').className = 'form-control';
//         if (event.keyCode === 13 && validator.validateUsername(username)) {
//             // event.preventDefault();
//             console.log(2);
//             // document.getElementById("login-button").click();
//         }
//     }
//     else {
//         document.querySelector('#password-input').className = 'form-control is-invalid';
//     }
//     document.querySelector('#password-error').innerHTML = validator.getPasswordError();
// });