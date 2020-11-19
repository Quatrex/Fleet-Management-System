class LogInValidator {
    constructor() {
        this.is_passed = false;
        this.errors = ['', ''];
    }

    validateUsername(username) {
        if (username == "") {
            this.errors[0] = "Username is required";
            return false;
        }
        else if (username.length < 3) {
            this.errors[0] = "Username must be at least 3 characters";
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
        else if (password.length < 3) {
            this.errors[1] = "Password must be at least 3 characters";
            return false;
        }
        else {
            this.errors[1] = '';
            return true;
        }
    }

    getUsernameError() {
        return this.errors[0];
    }

    getPasswordError() {
        return this.errors[1];
    }

    isvalidationPassed() {
        return this.errors == ['', ''];
    }
}