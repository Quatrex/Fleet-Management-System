class LogInValidator {
    constructor() {
        this.is_passed = false;
        this.errors = ['', ''];
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
        else if (password.length < 8) {
            this.errors[1] = "Password must be at least 8 characters";
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
        return this.errors == ['', ''];
    }
}