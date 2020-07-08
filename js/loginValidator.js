class LogInValidator {
    constructor(username, password) {
        this.username = username;
        this.password = password;
        this.is_passed = false;
        this.errors = ['', ''];
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
    validatePassword() {
        if (this.password == "") {
            return "Password is required";
        }
        return true

    }
}