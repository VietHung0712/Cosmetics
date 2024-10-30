document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");
    const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
    const confirmPassword = document.querySelector("#confirmPassword");

    // Xử lý hiển thị mật khẩu cho trường "Mật khẩu"
    if (togglePassword && password) {
        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.src = type === "text" ? "./assets/icons/eye.svg" : "./assets/icons/lock.svg";
        });
    }

    // Xử lý hiển thị mật khẩu cho trường "Xác nhận mật khẩu"
    if (toggleConfirmPassword && confirmPassword) {
        toggleConfirmPassword.addEventListener("click", function () {
            const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
            confirmPassword.setAttribute("type", type);
            this.src = type === "text" ? "./assets/icons/eye.svg" : "./assets/icons/lock.svg";
        });
    }
});
