class LogInValidator {
    constructor() {
        this.is_passed = false;
        this.errors = [false, false];
    }

    validateEmail(email) {
        if (email == "") {
            this.errors[0] = "Email is required";
            return false;
        }
        else if (!email.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/)) {
            this.errors[0] = "Not a valid email";
            return false;
        }
        else {
            this.errors[0] = '';
            return true;
        }
    }
    validatePassword(password) {
        if (password == "") {
            this.errors[1] = "Password is required";
            return false;
        }
        else if (!password.match(/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/)) {
            this.errors[1] = "Incorrect Password";
            return false;
        }
        else {
            this.errors[1] = '';
            return true;
        }
    }

    getEmailError() {
        return this.errors[0];
    }

    getPasswordError() {
        return this.errors[1];
    }

    isvalidationPassed() {
        console.log(this.errors == ['', '']);
        return this.errors == ['', ''];
    }
}