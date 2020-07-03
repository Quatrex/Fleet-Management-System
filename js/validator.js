class LogInValidator {
    constructor(username,password,name_error,password_error) {
        this.username = username;
        this.password = password;
    }


    validateUserName() {
        if (this.username == "") {
            return "Username is required";
        }
        if (this.username.length < 3) {
            return "Username must be at least 3 characters";
        }
        return true
    }
    validatePassword(){
        if (this.password == "") {
            return "Password is required";
        }
        return true

    }

    nameVerify() {
        if (this.username != "") {
            this.username.style.border = "1px solid #5e6e66";
            document.getElementById('username_div').style.color = "#5e6e66";
            this.name_error.innerHTML = "";
            return true;
        }
    }

    passwordVerify() {
        if (this.password != "") {
            this.password.style.border = "1px solid #5e6e66";
            this.document.getElementById('password_div').style.color = "#5e6e66";
            this.password_error.innerHTML = "";
            return true;
        }

    }
}